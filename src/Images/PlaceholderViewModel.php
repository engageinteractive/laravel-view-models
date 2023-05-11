<?php

namespace EngageInteractive\LaravelViewModels\Images;

class PlaceholderViewModel extends ImageViewModel
{
    public function __construct(ImageDimensions $dimensions)
    {
        parent::__construct($dimensions);
    }

    protected function srcItem($dimension)
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width=":width" height=":height" viewBox="0 0 :width :height">
<rect fill="#ddd" width=":width" height=":height"/>
<text fill="rgba(0,0,0,0.5)" font-family="sans-serif" font-size="30" dy="10.5" font-weight="bold" x="50%" y="50%" text-anchor="middle">:width×:height</text>
</svg>';

        $svg = str_replace(':width', $dimension['width'], $svg);
        $svg = str_replace(':height', $dimension['height'], $svg);

        return 'data:image/svg+xml,' . rawurlencode($svg);
    }

    protected function webpItem($dimension)
    {
        // no different for placeholders
        return $this->srcItem($dimension);
    }

    public function alt()
    {
        return 'Placeholder';
    }
}
