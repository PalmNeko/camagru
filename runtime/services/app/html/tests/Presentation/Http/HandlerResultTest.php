<?php

use PalmNeko\Camagru\Presentation\Http\{
    HandlerResult,
    Response,
};

describe('HandlerResult', function () {
    $response = new Response;
    $result1 = new HandlerResult(false);
    $result2 = new HandlerResult(true, $response);

    test('->isNext', function () use (& $result1, & $result2) {
        expect($result1->isNext())->toBeFalse();
        expect($result2->isNext())->toBeTrue();
    });

    test('->response', function () use (& $result1, & $result2, & $response) {
        expect($result1->response())->toBe(null);
        expect($result2->response())->toBe($response);
    });
});
