<?php

namespace CodePub\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Foundation\AliasLoader;
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
        $loader = AliasLoader::getInstance();
        $loader->alias('Accordion',\Bootstrapper\Facades\Accordion::class);
        $loader->alias('Alert', \Bootstrapper\Facades\Alert::class);
        $loader->alias('Badge', \Bootstrapper\Facades\Badge::class);
        $loader->alias('Breadcrumb', \Bootstrapper\Facades\Breadcrumb::class);
        $loader->alias('Button', \Bootstrapper\Facades\Button::class);
        $loader->alias('ButtonGroup', \Bootstrapper\Facades\ButtonGroup::class);
        $loader->alias('Carousel', \Bootstrapper\Facades\Carousel::class);
        $loader->alias('ControlGroup', \Bootstrapper\Facades\ControlGroup::class);
        $loader->alias('DropdownButton', \Bootstrapper\Facades\DropdownButton::class);
        $loader->alias('Helpers', \Bootstrapper\Facades\Helpers::class);
        $loader->alias('Icon', \Bootstrapper\Facades\Icon::class);
        $loader->alias('InputGroup', \Bootstrapper\Facades\InputGroup::class);
        $loader->alias('Image', \Bootstrapper\Facades\Image::class);
        $loader->alias('Label', \Bootstrapper\Facades\Label::class);
        $loader->alias('MediaObject', \Bootstrapper\Facades\MediaObject::class);
        $loader->alias('Modal', \Bootstrapper\Facades\Modal::class);
        $loader->alias('Navbar', \Bootstrapper\Facades\Navbar::class);
        $loader->alias('Navigation', \Bootstrapper\Facades\Navigation::class);
        $loader->alias('Panel', \Bootstrapper\Facades\Panel::class);
        $loader->alias('ProgressBar', \Bootstrapper\Facades\ProgressBar::class);
        $loader->alias('Tabbable', \Bootstrapper\Facades\Tabbable::class);
        $loader->alias('Table', \Bootstrapper\Facades\Table::class);
        $loader->alias('Thumbnail', \Bootstrapper\Facades\Thumbnail::class);
//        $loader->alias('Form', \Bootstrapper\Facades\Form::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
