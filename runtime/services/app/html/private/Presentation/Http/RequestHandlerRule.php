<?php

namespace PalmNeko\Camagru\Presentation\Http;

use Closure;

class RequestHandlerRule
{
    private function __construct(
        public private(set) EHttpMethod $method,
        public private(set) string $pattern,
        public private(set) Closure $handler,
    ) {}

    public static function get(string $pattern, Closure $handler): self
    {
        return new self(
            method: EHttpMethod::Get,
            pattern: $pattern,
            handler: $handler,
        );
    }

    public function isMatch(EHttpMethod $method, string $path): bool
    {
        return
            $this->method === $method
            && preg_match($this->pattern, $path) === 1;
    }
}
