<?php

namespace App\Repository\Concrete;

use App\Repository\Interfaces\IBaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseRepository implements IBaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = [], array $searchOptions = []): array
    {
        $record = $this->model
            ->with($relations)
            ->select($columns)
            ->get();

        return $record->toArray();
    }

    public function find(int $id, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->with($relations)->select($columns)->findOrFail($id)->append($appends);
    }

    /**
     * @throws Exception
     */
    public function save(array $payload): Model
    {
        DB::beginTransaction();
        try {
            $id = $payload['id'] ?? 0;
            if($id != 0){
                $this->find($id); // this will throw ModelNotFoundException if no record found.
            }
            $result = $this->model->updateOrCreate(['id' => $id], $payload);
            DB::commit();
            return $result;
        }
        catch (ModelNotFoundException $exception) {
            DB::rollBack();
            throw new Exception("Unable to update non-existing record.", 400);
        }
        catch (Exception $exception) {

            Log::debug($exception->getMessage());
            DB::rollBack();
            throw new Exception("Something went wrong", 500);
        }
    }

    public function delete(int $id): ?bool
    {
        return $this->find($id)->delete();
    }

}
