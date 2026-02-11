<?php

namespace Tests\Presentation\Http;

use PalmNeko\Camagru\Presentation\Http\{
    HandlerResult, IRequestHandler,
};

class TempHandler implements IRequestHandler {
    public function __construct(
        public HandlerResult $handlerResult
    ) {}

    public function invoke() : HandlerResult {
        return $this->handlerResult;
    }
}
