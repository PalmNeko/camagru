<?php

use PalmNeko\Camagru\Presentation\Http\{
    RequestHandlerRule,
    RequestRouter,
    HandlerResult
};
use Tests\Presentation\Http\TempHandler;

describe('TRequestHandlerRuleAppender', function () {
    test('->appendRule()', function () {
        $router = new RequestRouter();
        $response = new HandlerResult(false);
        $router->appendRule(RequestHandlerRule::get('pattern', new TempHandler($response)));
        expect(count($router->rules))->toBe(1);
    });
    test('->invoke()', function (array $testcase) {
        $router = new RequestRouter();
        $response = new HandlerResult(false);
        $handler = new TempHandler($response);
        $router->appendRule(RequestHandlerRule::get('/\/pattern/', $handler));
        var_dump($testcase);
        $_SERVER['REQUEST_METHOD'] = $testcase['request_method'];
        $_SERVER['REQUEST_URI'] = $testcase['request_uri'];
        http_response_code(200);
        $router->invoke();
        expect(http_response_code())->toBe($testcase['response_code']);
    })
    ->with([
        [[
            'testcase' => 'HappyPath',
            'request_method' => 'GET',
            'request_uri' => '/pattern',
            'response_code' => 200,
        ]],
        [[
            'testcase' => 'Invalid REQUEST_METHOD:400',
            'request_method' => 'NoMethod',
            'request_uri' => '/pattern',
            'response_code' => 400,
        ]],
        [[
            'testcase' => 'Not Supported REQUEST_METHOD:400',
            'request_method' => 'TRACE',
            'request_uri' => '/pattern',
            'response_code' => 400,
        ]],
        [[
            'testcase' => 'Not Found:404',
            'request_method' => 'GET',
            'request_uri' => '/notfound',
            'response_code' => 404,
        ]],
    ])
    ;
});
