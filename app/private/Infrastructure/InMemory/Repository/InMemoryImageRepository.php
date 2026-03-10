<?php

namespace PalmNeko\Camagru\Infrastructure\InMemory\Repository;

use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Repository\{
    IImageRepository
};
use PalmNeko\Camagru\Domain\ValueObject\ImageId;
use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryStorageClient;

class InMemoryImageRepository implements IImageRepository
{
    public function __construct(
        public private(set) InMemoryStorageClient $client,
    ) {}

    public function getAll(): array {
        return $this->client->data;
    }

    public function getById(ImageId $id): ImageAggregation | false {
        $key = json_encode($id);
        return $this->client->data[$key] ?? false;
    }

    public function insert(ImageAggregation $image) {
        $key = json_encode($image->id);
        $this->client->data[$key] = $image;
    }

    public function delete(ImageAggregation $image) {
        $key = json_encode($image->id);
        unset($this->client->data[$key]);
    }
}
