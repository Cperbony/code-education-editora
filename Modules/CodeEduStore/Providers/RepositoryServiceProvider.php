<?php

namespace CodeEduStore\Providers;

use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\BookRepositoryEloquent;
use CodeEduBook\Repositories\CategoryRepository;
use CodeEduBook\Repositories\CategoryRepositoryEloquent;
use CodeEduBook\Repositories\ChapterRepository;
use CodeEduBook\Repositories\ChapterRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
