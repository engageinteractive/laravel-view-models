<?php

namespace Tests\ViewModel\Resources;

use EngageInteractive\LaravelViewModels\ViewModel;

class TestedViewModel extends ViewModel
{
    protected $protectedProperty;

    public function __construct()
    {
        $this->protectedProperty = true;
    }

    public function shouldBeString()
    {
        return '';
    }

    public function shouldBeTrue()
    {
        return true;
    }

    protected function shouldBeHiddenProtected()
    {
        return null;
    }

    private function shouldBeHiddenPrivate()
    {
        return null;
    }
}
