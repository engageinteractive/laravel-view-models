<?php

namespace Tests\ViewModel;

use EngageInteractive\LaravelViewModels\ViewModel;
use Tests\ViewModel\Resources\TestedViewModel;
use Tests\ViewModel\Resources\TestedViewModelAlternateKey;
use Tests\TestCase;

class ViewModelTest extends TestCase
{
    public function test_returns_correct_array()
    {
        $viewModel = new TestedViewModel;
        $array = $viewModel->array();

        $this->assertArrayHasKey(ViewModel::DEFAULT_KEY, $array);

        $model = $array[ViewModel::DEFAULT_KEY];

        $this->assertArrayHasKey('should_be_string', $model);
        $this->assertArrayHasKey('should_be_true', $model);
    }

    public function test_does_not_return_hidden_methods()
    {
        $viewModel = new TestedViewModel;
        $viewModelArray = $viewModel->array();
        $model = $viewModelArray[ViewModel::DEFAULT_KEY];

        // Protected methods are hidden
        $this->assertArrayNotHasKey('should_be_hidden_protected', $model);

        // Private methods are hidden
        $this->assertArrayNotHasKey('should_be_hidden_private', $model);

        // Magic methods are hidden
        $this->assertArrayNotHasKey('__construct', $model);
    }

    public function test_has_alternate_key()
    {
        $viewModel = new TestedViewModelAlternateKey;
        $array = $viewModel->array();

        // Alternate key is present
        $this->assertArrayHasKey('alternate', $array);

        // Default key is not present
        $this->assertArrayNotHasKey(ViewModel::DEFAULT_KEY, $array);
    }
}
