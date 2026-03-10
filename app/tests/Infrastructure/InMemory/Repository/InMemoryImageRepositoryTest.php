<?php

use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;
use PalmNeko\Camagru\Infrastructure\InMemory\Repository\InMemoryImageRepository;
use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryStorageClient;


describe('InMemoryStorageClient', function () {
    test('->getAll()', function () {
        $imageId = new ImageId('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
        $imageEntity = new ImageEntity($imageId);
        $image = new ImageAggregation($imageEntity);
        $client = new InMemoryStorageClient([$image]);
        $repository = new InMemoryImageRepository($client);
        expect($repository->getAll())->toBe([$image]);
    });
});
