<?php

namespace CodePub\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

use Bootstrapper\Facades\Accordion;
use Bootstrapper\Facades\Alert;
use Bootstrapper\Facades\Badge;
use Bootstrapper\Facades\Breadcrumb;
use Bootstrapper\Facades\Button;
use Bootstrapper\Facades\ButtonGroup;
use Bootstrapper\Facades\Carousel;
use Bootstrapper\Facades\ControlGroup;
use Bootstrapper\Facades\DropdownButton;
use Bootstrapper\Facades\Helpers;
use Bootstrapper\Facades\Icon;
use Bootstrapper\Facades\Image;
use Bootstrapper\Facades\InputGroup;
use Bootstrapper\Facades\Label;
use Bootstrapper\Facades\MediaObject;
use Bootstrapper\Facades\Modal;
use Bootstrapper\Facades\Navbar;
use Bootstrapper\Facades\Navigation;
use Bootstrapper\Facades\Panel;
use Bootstrapper\Facades\ProgressBar;
use Bootstrapper\Facades\Tabbable;
use Bootstrapper\Facades\Table;
use Bootstrapper\Facades\Thumbnail;
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
        $loader->alias('Accordion', Accordion::class);
        $loader->alias('Alert', Alert::class);
        $loader->alias('Badge', Badge::class);
        $loader->alias('Badge', Badge::class);
        $loader->alias('Breadcrumb', Breadcrumb::class);
        $loader->alias('Button', Button::class);
        $loader->alias('ButtonGroup', ButtonGroup::class);
        $loader->alias('Carousel', Carousel::class);
        $loader->alias('ControlGroup', ControlGroup::class);
        $loader->alias('DropdownButton', DropdownButton::class);
        $loader->alias('Helpers', Helpers::class);
        $loader->alias('Icon', Icon::class);
        $loader->alias('InputGroup', InputGroup::class);
        $loader->alias('Image', Image::class);
        $loader->alias('Label', Label::class);
        $loader->alias('MediaObject', MediaObject::class);
        $loader->alias('Modal', Modal::class);
        $loader->alias('Navbar', Navbar::class);
        $loader->alias('Navigation', Navigation::class);
        $loader->alias('Panel', Panel::class);
        $loader->alias('ProgressBar', ProgressBar::class);
        $loader->alias('Tabbable', Tabbable::class);
        $loader->alias('Table', Table::class);
        $loader->alias('Thumbnail', Thumbnail::class);
//        $loader->alias('Form', \Bootstrapper\Facades\Form::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
