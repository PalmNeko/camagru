<?php

use PalmNeko\Camagru\Application\Image\GetAll\GetAllImageResult;
use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

describe('GetAllImageResult', function() {
    test('->gen()', function() {
        $rawUUIDs = [
            'a1de2f82-0530-2f32-99f5-6d4bd022573e',
            'c415b9ae-94fa-f97b-09ec-82174a6f4f10',
            'd5899240-f00a-3c50-69a8-2210b15f9f29'
        ];
        $images = array_map(function($rawUUID) {
            return new ImageAggregation(
                new ImageEntity(
                    new ImageId($rawUUID)
                )
            );
        }, $rawUUIDs);
        $result = new GetAllImageResult($images);
        $index = 0;
        foreach($result->gen() as $row) {
            expect($row->id)->toBe($rawUUIDs[$index]);
            $index++;
        }
    });
});
