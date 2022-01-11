<?php


namespace App\Repository\Concrete;


use App\Models\Brand;
use App\Models\Car;
use App\Repository\Interfaces\ICarRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CarRepository extends BaseRepository implements ICarRepository
{
    public function __construct(Car $model)
    {
        parent::__construct($model);
    }

    // Override default save function from base repository
    // Kung gusto mo may ubrahon ka danay antis e call ang save method.
    public function save(array $payload): Model
    {
        //Do some checks here
        //Check if brand id is on payload
        if(!isset($payload['brand_id']))
            //custom exception, gin gamit ko lang iya ka findOrFail nga exception
            throw new ModelNotFoundException("Brand id is required.", 400);

        //check brand on db, di ni mag throw error kay regular find lang ni
        $exist = Brand::find($payload['brand_id']);
        if(empty($exist))
            throw new ModelNotFoundException("Invalid brand id on payload: record does not exist.", 400);

        //kung ga exist ang brand save tana ang car, reuse lang ang BaseRepository nga save method
        return parent::save($payload); //Use base repo save method
    }
}
