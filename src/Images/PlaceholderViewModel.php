<?php

namespace EngageInteractive\LaravelViewModels\Images;

class PlaceholderViewModel extends ImageViewModel
{
    const URL_PREFIX = 'https://via.placeholder.com/';

    public function __construct(ImageDimensions $dimensions)
    {
        parent::__construct($dimensions);
    }

    protected function srcItem($dimension)
    {
        return self::URL_PREFIX.$dimension['width'].'x'.$dimension['height'];
    }

    protected function webpItem($dimension)
    {
        return self::URL_PREFIX.$dimension['width'].'x'.$dimension['height'].'.webp/888/000';
    }

    public function alt()
    {
        return 'Placeholder';
    }
}
