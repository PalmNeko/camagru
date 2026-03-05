<?php

namespace PalmNeko\Camagru\Application\Image;

use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;

class ImageView
{
    private object $properties;
    public string $id { get => $this->properties->id; }

    public function __construct(private ImageAggregation $image)
    {
        $this->properties = json_decode(json_encode($image));
    }
}
