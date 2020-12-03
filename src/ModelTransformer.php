<?php

namespace EngageInteractive\LaravelViewModels;

use Illuminate\Support\Str;

class ModelTransformer
{
    public static function convertToCamel(array $array)
    {
        $new = [];

        foreach ($array as $key => $value) {

            $key = Str::camel($key);

            if (is_array($value)) {
                $new[$key] = self::convertToCamel($value);
                continue;
            }

            $new[$key] = $value;
        }

        return $new;
    }
}
