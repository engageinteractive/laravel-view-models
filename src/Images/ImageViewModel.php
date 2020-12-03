<?php

namespace EngageInteractive\LaravelViewModels\Images;

use EngageInteractive\LaravelViewModels\ViewModel;

abstract class ImageViewModel extends ViewModel
{
    protected $dimensions;
    protected $sizes;

    public function __construct(ImageDimensions $dimensions)
    {
        $this->dimensions = $dimensions->dimensions();
        $this->sizes = $dimensions->sizes();
    }

    public function src()
    {
        if (!$this->dimensions) {
            return null;
        }

        $src = [];

        foreach ($this->dimensions as $dimension) {
            $src[] = $this->srcItem($dimension);
        }

        return $src;
    }

    protected function srcItem($dimension)
    {
        return null;
    }

    public function webp()
    {
        if (!$this->dimensions) {
            return null;
        }

        $webp = [];

        foreach ($this->dimensions as $dimension) {
            $webp[] = $this->webpItem($dimension);
        }

        return $webp;
    }

    protected function webpItem($dimension)
    {
        return null;
    }

    public function sizes()
    {
        if (!$this->sizes) {
            return null;
        }

        return $this->sizes;
    }

    public function alt()
    {
        return null;
    }
}
