<?php

namespace PalmNeko\Camagru\Presentation\Http;

class RequestHandlerRule implements IRequestHandler
{
    private function __construct(
        public private(set) EHttpMethod $method,
        public private(set) string $pattern,
        public private(set) IRequestHandler $handler,
    ) {}

    public static function add(EHttpMethod $method, string $pattern, IRequestHandler $handler): self
    {
        return new self(
            method: $method,
            pattern: $pattern,
            handler: $handler,
        );
    }

    public static function get(string $pattern, IRequestHandler $handler): self
    {
        return self::add(method: EHttpMethod::Get, pattern: $pattern, handler: $handler);
    }

    public static function post(string $pattern, IRequestHandler $handler): self
    {
        return self::add(method: EHttpMethod::Post, pattern: $pattern, handler: $handler);
    }

    public static function put(string $pattern, IRequestHandler $handler): self
    {
        return self::add(method: EHttpMethod::Put, pattern: $pattern, handler: $handler);
    }

    public static function delete(string $pattern, IRequestHandler $handler): self
    {
        return self::add(method: EHttpMethod::Delete, pattern: $pattern, handler: $handler);
    }

    public function invoke(Request $request): HandlerResult {
        return $this->handler->invoke($request);
    }

    public function isMatch(EHttpMethod $method, string $path): bool
    {
        return
            $this->method === $method
            && preg_match($this->pattern, $path) === 1;
    }
}
