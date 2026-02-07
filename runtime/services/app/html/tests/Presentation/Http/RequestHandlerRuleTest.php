<?php

use PalmNeko\Camagru\Presentation\Http\EHttpMethod;
use PalmNeko\Camagru\Presentation\Http\RequestHandlerRule;

describe('RequestHandlerRuleTest', function () {
    describe('::add(get,post,put,delete)', function () {
        test('HappyPath', function () use (& $rule) {
            $pattern = '/\/.*/';
            $rule = RequestHandlerRule::add(
                EHttpMethod::Get,
                $pattern,
                fn() => 'some');
            expect($rule->pattern)->toBe($pattern);
            expect($rule->method)->toBe(EHttpMethod::Get);
            expect(($rule->handler)())->toBe('some');
        });
    });
    describe('->isMatch', function () {
        $pattern = '/^\/path\/.+\/image/';
        $rule = RequestHandlerRule::get($pattern, fn() => 'some');
        test('HappyPath', function () use (& $rule) {
            expect($rule->isMatch(EHttpMethod::Get, '/path/abc/image'))->toBeTrue();
            expect($rule->isMatch(EHttpMethod::Get, '/path/abc/image/'))->toBeTrue();
            expect($rule->isMatch(EHttpMethod::Get, '/path/abc/image/hij'))->toBeTrue();
            expect($rule->isMatch(EHttpMethod::Get, '/path/abc/def/image'))->toBeTrue();
        });
        test('InvalidPath', function () use (& $rule, & $pattern) {
            expect($rule->isMatch(EHttpMethod::Post, '/path/abc/image'))->toBeFalse();

            expect($rule->isMatch(EHttpMethod::Get, $pattern))->toBeFalse();
            expect($rule->isMatch(EHttpMethod::Get, '^/path/.+/image'))->toBeFalse();
            expect($rule->isMatch(EHttpMethod::Get, '/path//image'))->toBeFalse();
            expect($rule->isMatch(EHttpMethod::Get, ' /path/abc/image'))->toBeFalse();
            expect($rule->isMatch(EHttpMethod::Get, 'invalid-root/path/abc/image'))->toBeFalse();
        });
    });
});
