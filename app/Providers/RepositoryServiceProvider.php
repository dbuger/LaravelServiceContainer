<?php

namespace App\Providers;

use App\Repository\Concrete\BrandRepository;
use App\Repository\Concrete\CarRepository;
use App\Repository\Interfaces\IBaseRepository;
use App\Repository\Concrete\BaseRepository;
use App\Repository\Interfaces\IBrandRepository;
use App\Repository\Interfaces\ICarRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IBrandRepository::class, BrandRepository::class);
        $this->app->bind(ICarRepository::class, CarRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
