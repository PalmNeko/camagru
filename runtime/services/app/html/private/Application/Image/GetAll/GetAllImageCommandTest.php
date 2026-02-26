<?php

use PalmNeko\Camagru\Application\Image\GetAll\GetAllImageCommand;

describe('GetAllImageCommand', function() {
    test('is empty', function() {
        $json = json_encode(new GetAllImageCommand());
        expect($json)->toBe('{}');
    });
});
