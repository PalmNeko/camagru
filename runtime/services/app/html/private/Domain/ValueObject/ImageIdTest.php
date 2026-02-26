<?php

use PalmNeko\Camagru\Domain\ValueObject\UUID;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

describe('ImageId', function () {
    test('extends UUID', function () {
        expect(get_parent_class(ImageId::class))->toBe(UUID::class);
    });
});
