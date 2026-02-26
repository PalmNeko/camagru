<?php

namespace PalmNeko\Camagru\Infrastructure\InMemory;

use Exception;
use PalmNeko\Camagru\Domain\Repository\{
    ITransactionManager
};

class InMemoryTransactionManager implements ITransactionManager
{
    public function __construct(
        public private(set) InMemoryStorageClient $client,
    ) {}

    public function transaction(callable $process) {
        $backup = $this->client->backup();
        try {
            return $process($this->client);
        } catch(Exception $exception) {
            $this->client->rollback($backup);
            throw $exception;
        }
    }
}
