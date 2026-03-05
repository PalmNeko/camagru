<?php

namespace PalmNeko\Camagru\Infrastructure\Repository\MySQL;

use Exception;
use mysqli;
use PalmNeko\Camagru\Domain\Repository\{
    ITransactionManager
};

class TransactionManager implements ITransactionManager
{
    public function __construct(
        private mysqli $client
    ) {}

    public function transaction(callable $process) {
        $this->client->begin_transaction();
        try {
            $result = $process($this->client);
            $this->client->commit();
            return $result;
        } catch(Exception $exception) {
            $this->client->rollback();
            throw $exception;
        }
    }
}
