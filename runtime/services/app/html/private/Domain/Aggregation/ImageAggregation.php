<?php

namespace PalmNeko\Camagru\Domain\Aggregation;

use PalmNeko\Camagru\Domain\Entity\{
    ImageEntity
};
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

class ImageAggregation
{

    public function __construct(
        private ImageEntity $image,
    ) {}

    public ImageId $id {
        get => $this->image->id;
    }
}
