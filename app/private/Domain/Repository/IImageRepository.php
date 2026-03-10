<?php

namespace PalmNeko\Camagru\Domain\Repository;

use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;

interface IImageRepository
{
    public function delete(ImageAggregation $image);
    public function getAll();
    public function getById(ImageId $id) : ImageAggregation | false;
    public function insert(ImageAggregation $image);
}
