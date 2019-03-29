<?php

namespace EngageInteractive\LaravelViewModels\Traits;

use Illuminate\Support\Arr;

trait Mapper
{
    /**
     * Builds the array version on the input parameter.
     *
     * @param mixed  $source
     * @return array
     */
    public function one($source)
    {
        return $this->map($source);
    }

    /**
     * Applies the map method to each element in the iterable.
     *
     * @param iterable  $iterable
     * @return array[]
     */
    public function all(iterable $iterable)
    {
        return collect($iterable)
            ->map(function ($source) {
                return $this->one($source);
            })
            ->values()
            ->all();
    }

    /**
     * Sets $value if not null.
     *
     * @param array  &$model
     * @param string  $path
     * @param mixed  $value
     * @return void
     */
    protected function maybeSet(&$model, $path, $value)
    {
        if ($value === null) {
            return;
        }

        Arr::set($model, $path, $value);
    }
}
