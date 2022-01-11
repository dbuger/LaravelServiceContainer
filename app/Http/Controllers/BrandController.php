<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\IBrandRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    private $repo;
    private $request;

    public function __construct(Request $request, IBrandRepository $repo)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function all(): JsonResponse
    {
        return response()->json($this->repo->all(
            ['*'],
            [],
            $this->request->get('searchOptions', []),
        ));
    }

    public function find($id): JsonResponse
    {
        return response()->json($this->repo->find($id));
    }

    public function save(): JsonResponse
    {
        try {
            $data = $this->request->all();
            return response()->json($this->repo->save($data));
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            if ($this->repo->delete($id) == true)
                return response()->json("Record deleted", 201);
        } catch (ModelNotFoundException $exception) {
            return response()->json("Record not found.", 404);
        } catch (Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
