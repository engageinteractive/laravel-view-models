<?php

use EngageInteractive\LaravelViewModels\Images\PlaceholderViewModel;
use EngageInteractive\LaravelViewModels\Images\ImageDimensions;
use EngageInteractive\LaravelViewModels\ModelTransformer;

if (! function_exists('image_placeholder')) {
    /**
     * Returns an image placeholder model.
     *
     * @param string $key
     * 
     * @return array
     */
    function image_placeholder($key)
    {
        $dimensions = new ImageDimensions($key);
        $model = new PlaceholderViewModel($dimensions);

        return $model->getData();
    }
}

if (! function_exists('model_to_camel_case')) {
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
