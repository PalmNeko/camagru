<?php

namespace PalmNeko\Camagru\Domain\Repository;

interface ITransactionManager
{
    public function transaction(callable $process);
}
