<?php

use PalmNeko\Camagru\Presentation\Http\{
    EHttpMethod,
    RequestHandlerRule,
    HandlerResult,
};
use Tests\Presentation\Http\TempHandler;

describe('RequestHandlerRuleTest', function () {
    test('::add(get,post,put,delete)', function () {
        $pattern = '/\/.*/';
        $response = new HandlerResult(false);
        $rule = RequestHandlerRule::add(
            EHttpMethod::Get,
            $pattern,
            new TempHandler($response));
        expect($rule->pattern)->toBe($pattern);
        expect($rule->method)->toBe(EHttpMethod::Get);
        expect($rule->handler->invoke())->toBe($response);
    });
    test('->isMatch', function () {
        $pattern = '/^\/path\/.+\/image/';
        $response = new HandlerResult(false);
        $rule = RequestHandlerRule::get($pattern, new TempHandler($response));
        expect($rule->isMatch(EHttpMethod::Get, '/path/abc/image'))->toBeTrue();
        expect($rule->isMatch(EHttpMethod::Get, '/path/abc/image/'))->toBeTrue();
        expect($rule->isMatch(EHttpMethod::Get, '/path/abc/image/hij'))->toBeTrue();
        expect($rule->isMatch(EHttpMethod::Get, '/path/abc/def/image'))->toBeTrue();
        // will be false
        expect($rule->isMatch(EHttpMethod::Post, '/path/abc/image'))->toBeFalse();
        expect($rule->isMatch(EHttpMethod::Get, $pattern))->toBeFalse();
        expect($rule->isMatch(EHttpMethod::Get, '^/path/.+/image'))->toBeFalse();
        expect($rule->isMatch(EHttpMethod::Get, '/path//image'))->toBeFalse();
        expect($rule->isMatch(EHttpMethod::Get, ' /path/abc/image'))->toBeFalse();
        expect($rule->isMatch(EHttpMethod::Get, 'invalid-root/path/abc/image'))->toBeFalse();
    });
});
