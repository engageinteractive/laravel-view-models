<?php

namespace EngageInteractive\LaravelViewModels\Images;

class ImageDimensions
{
    const CONFIG_KEY = 'images.transforms';

    protected $transforms;
    protected $dimensions;
    protected $sizes;

    public function __construct(string $key)
    {
        $this->transforms = $this->getConfigTransforms($key);
        $this->dimensions = $this->calculateDimensions();
        $this->sizes = $this->calculateSizes();
    }

    public function getConfigTransforms(string $key)
    {
        return config(self::CONFIG_KEY . '.' . $key);
    }

    public function dimensions()
    {
        return $this->dimensions;
    }

    public function sizes()
    {
        return $this->sizes;
    }

    protected function calculateDimensions()
    {
        $dimensions = [];

        foreach($this->transforms as $variant) {
            if (!isset($variant['ratio'])) {
                continue;
            }

            $ratio = explode(':', $variant['ratio']);

            if (!is_array($ratio)) {
                continue;
            }

            $width = $variant['width'];
            $height = self::calculateHeight($width, $ratio[1], $ratio[0]);

            $dimensions[] = [
                'width' => (int) $width,
                'height' => (int) $height,
            ];
        }

        return $dimensions;
    }

    protected function calculateSizes()
    {
        $sizes = [];

        foreach ($this->transforms as $variant) {
            if (!isset($variant['min'])) {
                continue;
            }

            $sizes[] = $variant['min'];
        }

        if (!$sizes) {
            return null;
        }

        return $sizes;
    }

    protected static function calculateHeight($width, $ratio1, $ratio2)
    {
        return $width * $ratio1 / $ratio2;
    }
}
