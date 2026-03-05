<?php

namespace PalmNeko\Camagru\Application\Image\GetAll;

use PalmNeko\Camagru\Domain\{
    Repository\IImageRepository,
    Repository\ITransactionManager
};

class GetAllImage
{
    public function __construct(
        private IImageRepository $imageRepository,
        private ITransactionManager $transactionManager,
    ) {}

    public function execute(GetAllImageCommand $command) {
        $images = $this->transactionManager->transaction(function () use (& $command) {
            return $this->imageRepository->getAll();
        });
        $result = new GetAllImageResult($images);
        return $result;
    }
}
