<?php

namespace PalmNeko\Camagru\Presentation\Http;

class Request
{

    public function __construct(
        public private(set) EHttpMethod $method,
        public private(set) URL $url,
        public private(set) Headers $headers
    ) {}

    public static function parse_from_globals() : self {
        $method = EHttpMethod::from_string($_SERVER['REQUEST_METHOD']);
        $url = new URL($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
        $headers = new Headers();
        foreach(getallheaders() as $name => $value) {
            $headers->append($name, $value);
        }
        return new self(
            method: $method,
            url: $url,
            headers: $headers
        );
    }
}
