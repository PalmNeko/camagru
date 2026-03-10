<?php

use PalmNeko\Camagru\Application\Image\ImageView;
use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

describe('ImageView', function() {
    test('->id', function() {
        $raw_uuid = 'fd3fe361-8754-4dfa-ab4b-aae2af9de82f';
        $imageId = new ImageId($raw_uuid);
        $imageEntity = new ImageEntity($imageId);
        $image = new ImageAggregation($imageEntity);
        $imageView = new ImageView($image);
        expect($imageView->id)->toBe($raw_uuid);
    });
});
