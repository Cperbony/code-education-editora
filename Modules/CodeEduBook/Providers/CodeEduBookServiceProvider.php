<?php

namespace CodeEduBook\Providers;

use Folklore\Image\ImageServiceProvider;
use Illuminate\Support\ServiceProvider;

class CodeEduBookServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->publishMigrationsAndSeeders();
        $this->publishAssets();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('codeedubook.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'codeedubook'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/codeedubook');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/codeedubook';
        }, \Config::get('view.paths')), [$sourcePath]), 'codeedubook');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/codeedubook');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'codeedubook');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'codeedubook');
        }
    }

    public function publishMigrationsAndSeeders()
    {
        $sourcePath = __DIR__ . '/../database/migrations';

        $this->publishes([
            $sourcePath => database_path('migrations')
        ], 'migrations');

        $sourcePath = __DIR__ . '/../database/seeders';

        $this->publishes([
            $sourcePath => database_path('seeds')
        ], 'seeders');
    }

    public function publishAssets()
    {
        $sourcePath = __DIR__ . '/../resources/assets/js';

        $this->publishes([
            $sourcePath => public_path('js')
        ], 'assets');
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