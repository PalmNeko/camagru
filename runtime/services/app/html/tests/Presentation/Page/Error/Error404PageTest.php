<?php

use PalmNeko\Camagru\Presentation\Page\Error\Error404Page;

describe('Error404Page', function () {
    test('status', function () {
        Error404Page::set();
        expect(http_response_code())->toBe(404);
    });
});
