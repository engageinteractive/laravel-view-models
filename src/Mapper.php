<?php

namespace EngageInteractive\LaravelViewModels;

use Illuminate\Support\Arr;

use EngageInteractive\LaravelViewModels\Contracts\Mapper as MapperContract;
use EngageInteractive\LaravelViewModels\Traits\Mapper as MapperTrait;

abstract class Mapper implements MapperContract
{
    use MapperTrait;
}
