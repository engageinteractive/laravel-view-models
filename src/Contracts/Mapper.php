<?php

namespace EngageInteractive\LaravelViewModels\Contracts;

interface Mapper
{
    /**
     * Builds the array version on the input parameter.
     *
     * @param mixed  $source
     * @return array
     */
    public function one($source);

    /**
     * Applies the map method to each element in the iterable.
     *
     * @param iterable  $iterable
     * @return array[]
     */
    public function all(iterable $iterable);
}
