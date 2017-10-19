<?php

namespace CodePub\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::macro(/**
         * @param $field
         * @param $errors
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
         */
            'error', function ($field, $errors) {
            if (!str_contains($field, '.*') && $errors->has($field) || count($errors->get($field)) > 0) {
                return view('errors.error_field', compact('field'));
            }
            return null;
        });

        \Html::macro('openFormGroup', function ($field = null, $errors = null) {
            $result = false;
            if ($field != null and $errors != null) {
                if (is_array($field)) {
                    foreach ($field as $value) {
                        if (!str_contains($value, '.*') && $errors->has($value) || count($errors->get($value)) > 0) {
                            $result = true;
                            break;
                        }
                    }
                } else {
                    if (!str_contains($field, '.*') && $errors->has($field) || count($errors->get($field)) > 0) {
                        $result = true;
                    }
                }
            }
            $hasError = $result ? ' has-error' : '';
            return "<div class=\"form-group{$hasError}\">";
        });

        \Html::macro('closeFormGroup', function () {
            return '</div>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
