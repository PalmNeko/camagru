<?php

namespace PalmNeko\Camagru\Infrastructure\Repository\MySQL;

use mysqli;

use PalmNeko\Camagru\Domain\Repository\{
    IImageRepository
};

class ImageRepository implements IImageRepository
{
    public function __construct(
        private mysqli $client
    ) {}

    public function getAll(): array {
        $stmt = $this->client->prepare('SELECT * from images;');
        $stmt->execute();
        $stmt->bind_result($district);
        $stmt->fetch();
        return $district;
    }
}
