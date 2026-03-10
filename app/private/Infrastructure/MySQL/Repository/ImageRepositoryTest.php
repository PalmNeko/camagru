<?php

use PalmNeko\Camagru\Client\Development\MySQLClient;
use PalmNeko\Camagru\Domain\Aggregation\ImageAggregation;
use PalmNeko\Camagru\Domain\Entity\ImageEntity;
use PalmNeko\Camagru\Domain\ValueObject\ImageId;
use PalmNeko\Camagru\Infrastructure\MySQL\Repository\ImageRepository;
use PalmNeko\Camagru\Infrastructure\MySQL\TransactionManager;
use Tests\ForTest\ForRollbackException;

describe("ImageRepository", function () {
    $client = MySQLClient::staticClient();
    $repo = new ImageRepository($client);
    $transaction = new TransactionManager($client);
    test("->getAll()", function () use (&$repo, &$transaction) {
        $transaction->transaction(function () use (&$repo) {
            $images = $repo->getAll();
            expect(isset($images[0]->id))->toBeTrue();
        });
    });

    test("->getById()", function () use (&$repo, &$transaction) {
        $transaction->transaction(function () use (&$repo) {
            $dep_id = new ImageId('019c92f5-d7ad-7f52-a0b8-293b6d3b6bee');
            $image = $repo->getById($dep_id);
            expect($image->id == $dep_id)->toBeTrue();

            $dep_id = new ImageId('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
            $image = $repo->getById($dep_id);
            expect($image)->toBeFalse();
        });
    });

    test("->insert()", function () use (&$repo, &$transaction) {
        try {
            $transaction->transaction(function () use (&$repo) {
                $dep_id = new ImageId('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa');
                $dep_image = new ImageAggregation(new ImageEntity($dep_id));
                expect($repo->insert($dep_image))->toBeTrue();
                $image = $repo->getById($dep_id);
                expect($image->id == $dep_id)->toBeTrue();

                expect(fn() => $repo->insert($dep_image))->toThrow(mysqli_sql_exception::class);
                throw new ForRollbackException('ロールバックするためだけの例外');
            });
        } catch (ForRollbackException) {
        }
    });

    test("->delete()", function () use (&$repo, &$transaction) {
        try {
            $transaction->transaction(function () use (&$repo) {
                $dep_id = new ImageId('019c92f5-d7ad-7f52-a0b8-293b6d3b6bee');
                $dep_image = new ImageAggregation(new ImageEntity($dep_id));
                expect($repo->delete($dep_image))->toBeTrue();
                $image = $repo->getById($dep_id);
                expect($image)->toBeFalse();

                // 存在しないIDの削除
                expect($repo->delete($dep_image))->toBeFalse();
                throw new ForRollbackException('ロールバックするためだけの例外');
            });
        } catch (ForRollbackException) {
        }
    });
});
