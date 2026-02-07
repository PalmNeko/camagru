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

    public static function add(EHttpMethod $method, string $pattern, Closure $handler): self
    {
        return new self(
            method: $method,
            pattern: $pattern,
            handler: $handler,
        );
    }

    public static function get(string $pattern, Closure $handler): self
    {
        return self::add(method: EHttpMethod::Get, pattern: $pattern, handler: $handler);
    }

    public static function post(string $pattern, Closure $handler): self
    {
        return self::add(method: EHttpMethod::Post, pattern: $pattern, handler: $handler);
    }

    public static function put(string $pattern, Closure $handler): self
    {
        return self::add(method: EHttpMethod::Put, pattern: $pattern, handler: $handler);
    }

    public static function delete(string $pattern, Closure $handler): self
    {
        return self::add(method: EHttpMethod::Delete, pattern: $pattern, handler: $handler);
    }

    public function isMatch(EHttpMethod $method, string $path): bool
    {
        return
            $this->method === $method
            && preg_match($this->pattern, $path) === 1;
    }
}
