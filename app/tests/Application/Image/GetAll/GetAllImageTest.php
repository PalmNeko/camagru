<?php

use PalmNeko\Camagru\Application\Image\GetAll\GetAllImage;
use PalmNeko\Camagru\Application\Image\GetAll\GetAllImageCommand;
use PalmNeko\Camagru\Application\Image\GetAll\GetAllImageResult;
use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;
use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryStorageClient;
use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryTransactionManager;
use PalmNeko\Camagru\Infrastructure\InMemory\Repository\InMemoryImageRepository;
use PalmNeko\Camagru\Infrastructure\Repository\MySQL\ImageRepository;


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
        $client = new InMemoryStorageClient($images);
        $repository = new InMemoryImageRepository($client);
        $transactionManager = new InMemoryTransactionManager($client);
        $service = new GetAllImage($repository, $transactionManager);
        $result = $service->execute(new GetAllImageCommand());
        $index = 0;
        foreach($result->gen() as $row) {
            expect($row->id)->toBe($rawUUIDs[$index]);
            $index++;
        }
    });
});
