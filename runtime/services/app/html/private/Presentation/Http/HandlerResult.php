<?php

namespace PalmNeko\Camagru\Presentation\Http;

class HandlerResult
{
    public function __construct(
        public bool $isNext = true,
        public ?Response $response = null,
    ) {}

    public function isNext(): bool {
        return $this->isNext;
    }

    public function response(): ?Response {
        return $this->response;
    }
}
