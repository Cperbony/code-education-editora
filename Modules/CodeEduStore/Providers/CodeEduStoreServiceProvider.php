<?php

namespace CodeEduStore\Providers;

use Illuminate\Support\ServiceProvider;

class CodeEduStoreServiceProvider extends ServiceProvider
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
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('codeedustore.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'codeedustore'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/codeedustore');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/codeedustore';
        }, \Config::get('view.paths')), [$sourcePath]), 'codeedustore');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/codeedustore');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'codeedustore');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'codeedustore');
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
        $sourcePathImg = __DIR__ . '/../resources/img';
        $sourcePathSass = __DIR__ . '/../resources/sass';


        $this->publishes([
            $sourcePathImg => public_path('img'),
            $sourcePathSass => base_path('resources/assets/sass'),
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