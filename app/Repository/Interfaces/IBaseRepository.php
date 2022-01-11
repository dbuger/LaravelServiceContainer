<?php


namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{

    public function all(
        array $columns = ['*'],
        array $relations = [],
        array $searchOptions = []
    ): array;

    public function find(int $id, array $columns = ['*'], array $relations = [], array $appends = []): ?Model;

    public function save(array $payload): Model;

    public function delete(int $id): ?bool;

}
