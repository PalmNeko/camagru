<?php

use PalmNeko\Camagru\Presentation\Http\EHttpMethod;
use PalmNeko\Camagru\Presentation\Http\Request;

describe('Request', function () {
    test('::parse_from_globals()', function () {
        $_SERVER['REQUEST_METHOD'] = 'Get';
        $_SERVER['REQUEST_SCHEME'] = 'http';
        $_SERVER['SERVER_NAME'] = 'camagru.com';
        $_SERVER['REQUEST_URI'] = '/some_path?hoge#tarou';

        $request = Request::parse_from_globals();

        expect(isset($request->headers))->toBe(true);
        expect($request->url->href)->toBe('http://camagru.com/some_path?hoge#tarou');
        expect($request->method)->toBe(EHttpMethod::Get);
    });
});
