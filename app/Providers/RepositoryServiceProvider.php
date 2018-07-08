<?php

namespace CodePub\Providers;

use CodeEduStore\Repositories\CategoryRepository;
use CodeEduStore\Repositories\ProductRepository;
use CodePub\Repositories\CategoryStoreRepositoryEloquent;
use CodePub\Repositories\ProductStoreRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

//        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryStoreRepositoryEloquent::class);
        $this->app->bind(ProductRepository::class, ProductStoreRepositoryEloquent::class);

        //:end-bindings:
    }
}
