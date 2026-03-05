<?php

use PalmNeko\Camagru\Presentation\Page\Error\Error400Page;

describe('Error400Page', function () {
    it('status', function() {
        Error400Page::set();
        expect(http_response_code())->toBe(400);
    });
});
