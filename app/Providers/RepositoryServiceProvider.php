<?php

namespace App\Providers;

use App\Repository\Concrete\BrandRepository;
use App\Repository\Interfaces\IBaseRepository;
use App\Repository\Concrete\BaseRepository;
use App\Repository\Interfaces\IBrandRepository;
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
