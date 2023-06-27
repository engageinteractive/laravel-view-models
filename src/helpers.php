<?php

use EngageInteractive\LaravelViewModels\ModelTransformer;

if (!function_exists('model_to_camel_case')) {
    /**
     * Returns an image placeholder model.
     *
     * @param string $key
     *
     * @return array
     */
    function model_to_camel_case($model)
    {
        return ModelTransformer::convertToCamel($model);
    }
}
