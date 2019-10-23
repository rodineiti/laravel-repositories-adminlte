<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    ProductRepositoryInterface,
    CategoryRepositoryInterface
};
use App\Repositories\Core\Eloquent\{
    EloquentProductRepository,
    EloquentCategoryRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*
        * Registrando repositories
        * Onde for injetada a interface ProductRepositoryInterface, cria um objeto da classe ProductRepositoryInterface
        */
        app()->bind(
            ProductRepositoryInterface::class,
            EloquentProductRepository::class
        );

        app()->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
