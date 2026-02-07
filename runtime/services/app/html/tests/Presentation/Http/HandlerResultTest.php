<?php

use PalmNeko\Camagru\Presentation\Http\{
    HandlerResult,
    Response,
};

describe('HandlerResult', function () {
    $result1 = new HandlerResult(false);
    $result2 = new HandlerResult(true);

    test('->isNext', function () use (& $result1, & $result2) {
        expect($result1->isNext())->toBeFalse();
        expect($result2->isNext())->toBeTrue();
    });
});
