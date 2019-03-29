<?php

namespace Tests\Unit;

use Mockery as m;

use EngageInteractive\LaravelViewModels\Mapper;

use Tests\TestCase;

class MapperTest extends TestCase
{
    public function test_one_CallsMapWithSource()
    {
        // Given
        $mapper = m::mock(Mapper::class)->makePartial();

        // Then
        $mapper->shouldReceive('map')
            ->with($source = new \stdClass)
            ->once()
            ->andReturn(null);

        // When
        $mapper->one($source);
    }

    public function test_all_CallsMapWithSource()
    {
        // Given
        $mapper = m::mock(Mapper::class)->makePartial();

        // Then
        $mapper->shouldReceive('map')
            ->with($source = new \stdClass)
            ->once()
            ->andReturn(null);

        // When
        $mapper->all([ $source ]);
    }
}
