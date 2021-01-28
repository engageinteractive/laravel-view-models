<?php

namespace EngageInteractive\LaravelViewModels;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ViewModelsServiceProvider extends ServiceProvider
{
    /**
     * Defines Laravel resources and routes.
     *
     * @return void
     */
    public function boot()
    {
        $this->defineBladeDirectives();
    }

    protected function defineBladeDirectives()
    {
        Blade::directive('vuemodel', function ($model) {
            return "{{ json_encode(model_to_camel_case($model)) }}";
        });
    }
}
