<?php

namespace PalmNeko\Camagru\Presentation\Http;

class HandlerResult
{
    public function __construct(
        public bool $isNext = true,
    ) {}

    public function isNext(): bool {
        return $this->isNext;
    }
}
