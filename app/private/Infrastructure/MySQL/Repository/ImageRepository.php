<?php

namespace PalmNeko\Camagru\Infrastructure\MySQL\Repository;

use mysqli;
use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\Repository\{
    IImageRepository
};
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

class ImageRepository implements IImageRepository
{
    public function __construct(
        private mysqli $client
    ) {}

    public function delete(ImageAggregation $image)
    {
        $stmt = $this->client->prepare(<<<EOF
        DELETE FROM images WHERE id=?
        ;
        EOF);
        if (!($id = strval($image->id))) return false;
        if (!$stmt->bind_param("s", $id)) return false;
        if (!$stmt->execute()) return false;
        return $stmt->affected_rows > 0;
    }

    public function getAll(): array | false
    {
        $stmt = $this->client->prepare('SELECT * from images;');
        if (!$stmt) return false;
        if (!$stmt->execute()) return false;
        if (!($result = $stmt->get_result())) return false;
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $id = new ImageId($row['id']);
            $imageEntity = new ImageEntity($id);
            $images[] = new ImageAggregation($imageEntity);
        }
        return $images;
    }

    public function getById(ImageId $id): ImageAggregation | false
    {
        $stmt = $this->client->prepare('SELECT * from images WHERE id=?;');
        if (!$stmt) return false;
        if (!($str_id = strval($id))) return false;
        if (!$stmt->bind_param("s", $str_id)) return false;
        if (!$stmt->execute()) return false;
        if (!($result = $stmt->get_result())) return false;
        $row = $result->fetch_assoc();
        if (!$row) return false;
        $id = new ImageId($row['id']);
        $imageEntity = new ImageEntity($id);
        $image = new ImageAggregation($imageEntity);
        return $image;
    }

    public function insert(ImageAggregation $image): bool
    {
        $stmt = $this->client->prepare(<<<EOF
        INSERT INTO images VALUE (
            ?
        )
        ;
        EOF);
        if (!$stmt) return false;
        if (!($id = strval($image->id))) return false;
        if (!$stmt->bind_param("s", $id)) return false;
        return $stmt->execute();
    }
}
