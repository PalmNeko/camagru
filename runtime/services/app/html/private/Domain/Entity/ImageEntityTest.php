<?php

use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

describe('ImageEntity', function() {
    test('->id', function() {
        $imageId = new ImageId('fd3fe361-8754-4dfa-ab4b-aae2af9de82f');
        $imageEntity = new ImageEntity($imageId);
        expect($imageEntity->id)->toBe($imageId);
    });
});
