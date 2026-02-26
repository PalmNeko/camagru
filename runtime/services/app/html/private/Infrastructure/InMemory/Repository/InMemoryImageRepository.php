<?php

namespace PalmNeko\Camagru\Infrastructure\Repository\InMemory;

use PalmNeko\Camagru\Domain\Repository\{
    IImageRepository
};

class InMemoryImageRepository implements IImageRepository
{
    public function __construct(
        public private(set) InMemoryStorageClient $client,
    ) {}

    public function getAll(): array {
        return $this->client->data;
    }
}
