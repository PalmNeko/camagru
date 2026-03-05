<?php

namespace PalmNeko\Camagru\Domain\Entity;

use PalmNeko\Camagru\Domain\ValueObject\{
    ImageId
};

class ImageEntity {
    public function __construct(
        public private(set) ImageId $id
    ) {}
}
