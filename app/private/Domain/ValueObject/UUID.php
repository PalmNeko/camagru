<?php

namespace PalmNeko\Camagru\Domain\ValueObject;

use JsonSerializable;

class UUID implements JsonSerializable {

    public function __construct(
        public private(set) string $value
    ) {}

    public function __toString() : string {
        return $this->value;
    }

    public function jsonSerialize() : string {
        return $this->value;
    }
}
