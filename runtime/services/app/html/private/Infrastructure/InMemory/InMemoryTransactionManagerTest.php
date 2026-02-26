<?php

use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryStorageClient;
use PalmNeko\Camagru\Infrastructure\InMemory\InMemoryTransactionManager;


describe('InMemoryTransactionManager', function() {
    test('->transaction()', function() {
        $client = new InMemoryStorageClient([
            '1', '2', '3'
        ]);
        $transactionManager = new InMemoryTransactionManager($client);
        $result = $transactionManager->transaction(function() use (&$client) {
            $client->append('4');
            return 123;
        });
        expect($result)->toBe(123);
        expect($client->data)->toBe(['1', '2', '3', '4']);
    });

    test('->transaction() rollback on error', function () {
        $client = new InMemoryStorageClient([
            '1', '2', '3'
        ]);
        $transactionManager = new InMemoryTransactionManager($client);
        try {
            $transactionManager->transaction(function() use (&$client) {
                $client->append('4');
                throw new Exception('123');
            });
        } catch (Exception $e) {
            expect($e->getMessage())->toBe('123');
        }
        expect($client->data)->toBe(['1', '2', '3']);
    });
});
