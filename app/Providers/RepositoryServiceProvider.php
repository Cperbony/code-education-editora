<?php

namespace CodePub\Providers;

use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Repositories\UserRepositoryEloquent;
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

        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);

        //:end-bindings:
    }
}
