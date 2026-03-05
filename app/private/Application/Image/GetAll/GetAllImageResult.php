<?php

namespace PalmNeko\Camagru\Application\Image\GetAll;

use PalmNeko\Camagru\Application\Image\ImageView;

class GetAllImageResult
{
    public private(set) array $images;

    public function __construct(
        array $images
    ) {
        $this->images = array_map(fn($image) => new ImageView($image), $images);
    }

    public function gen() : iterable {
        foreach ($this->images as $key => $value) {
            yield $key => $value;
        }
    }
}
