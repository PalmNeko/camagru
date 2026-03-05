<?php

use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

describe('ImageAggregation', function () {
    test('->id', function () {
        $imageId = new ImageId('fd3fe361-8754-4dfa-ab4b-aae2af9de82f');
        $image = new ImageAggregation(new ImageEntity($imageId));
        expect($image->id)->toBe($imageId);
    });
});
