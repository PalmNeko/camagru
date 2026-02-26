<?php

namespace PalmNeko\Camagru\Infrastructure\InMemory\Repository;

use PalmNeko\Camagru\Domain\Repository\{
    IImageRepository
};
use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryStorageClient;

class InMemoryImageRepository implements IImageRepository
{
    public function __construct(
        public private(set) InMemoryStorageClient $client,
    ) {}

    public function getAll(): array {
        return $this->client->data;
    }
}
