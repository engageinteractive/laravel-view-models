<?php

namespace EngageInteractive\LaravelViewModels;

use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use Closure;

abstract class ViewModel
{
    const DEFAULT_KEY = 'model';

    /**
     * @var string $key
     */
    protected $key = self::DEFAULT_KEY;

    /**
     * @var array $model
     */
    protected $model = [];

    /**
     * Builds the model data and returns a view model array.
     *
     * @return array
     */
    public function array()
    {
        $this->buildModelData();

        return [
            $this->key => $this->model
        ];
    }

    /**
     * Populates the model array property with data from 
     * the result of public methods.
     *
     * @return void
     */
    protected function buildModelData()
    {
        $class = new ReflectionClass($this);

        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            if (self::shouldIgnoreMethod($method->name)) {
                continue;
            }

            $key = $this->getMethodKey($method);
            $value = $this->getMethodValue($method);

            $this->model[$key] = $value;
        }
    }

    /**
     * Returns a snake-cased key from a method name.
     *
     * @param ReflectionMethod $method
     * 
     * @return string
     */
    protected function getMethodKey(ReflectionMethod $method)
    {
        return Str::snake($method->name);
    }

    /**
     * Returns the result the method passed into the 
     * method parameter.
     * 
     * @param ReflectionMethod $method
     * 
     * @return mixed
     */
    protected function getMethodValue(ReflectionMethod $method)
    {
        if ($method->getNumberOfParameters() === 0) {
            return $this->{$method->getName()}();
        }

        return Closure::fromCallable([$this, $method->getName()]);
    }

    /**
     * Returns true or false whether the passed method
     * should be ignored.
     *
     * @return boolean
     */
    protected static function shouldIgnoreMethod($methodName)
    {
        if (Str::startsWith($methodName, '__')) {
            return true;
        }

        return in_array($methodName, ['array']);
    }
}
