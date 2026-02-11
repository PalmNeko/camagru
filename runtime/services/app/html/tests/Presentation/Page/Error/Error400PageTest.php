<?php

use PalmNeko\Camagru\Presentation\Page\Error\Error400Page;

describe('Error400Page', function () {
    Error400Page::set();
    it('status', function() {
        expect(http_response_code())->toBe(400);
    });
});
