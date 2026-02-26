<?php

namespace PalmNeko\Camagru\Infrastructure\InMemory;

class InMemoryStorageClient
{
    public function __construct(
        public private(set) array $data,
    ) {}

    public function append(mixed $value) {
        $this->data[] = $value;
    }

    public function equal(self $other) : bool {
        return $this->data === $other->data;
    }

    public function backup() : self {
        return unserialize(serialize($this));
    }

    public function rollback(self $backup) {
        $this->data = $backup->data;
    }
}
