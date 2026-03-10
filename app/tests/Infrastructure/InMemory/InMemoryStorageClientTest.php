<?php

use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryStorageClient;

describe('InMemoryStorageClient', function () {
    test('->append()', function () {
        $storage = new InMemoryStorageClient(['1', '2']);
        $storage->append('3');
        expect($storage->data)->toBe(['1', '2', '3']);
    });

    test('->backup(), ->rollback()', function () {
        $storage = new InMemoryStorageClient(['1', '2']);
        $backup = $storage->backup();
        expect($backup->data)->toBe(['1', '2']);
        $storage->append('3');
        $storage->rollback($backup);
        expect($storage->data)->toBe(['1', '2']);
    });

    test('->equal()', function () {
        $storage1 = new InMemoryStorageClient(['1', '2']);
        $storage2 = new InMemoryStorageClient(['1', '2']);
        expect($storage1->equal($storage2))->toBeTrue();
    });
});
