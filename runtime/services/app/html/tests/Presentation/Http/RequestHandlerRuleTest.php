<?php

use PalmNeko\Camagru\Presentation\Http\{
    EHttpMethod,
    RequestHandlerRule,
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

describe('RequestHandlerRuleTest', function () {
    describe('::add(get,post,put,delete)', function () {
        test('HappyPath', function () use (& $rule) {
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
    });
    describe('->isMatch', function () {
        $pattern = '/^\/path\/.+\/image/';
        $response = new HandlerResult(false);
        $rule = RequestHandlerRule::get($pattern, new TempHandler($response));
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
