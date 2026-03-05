<?php

namespace Tests\Domain\ValueObject;

use PalmNeko\Camagru\Domain\ValueObject\UUID;

describe('UUID', function () {
    test('->jsonSerialize()', function () {
        $uuid_raw = 'fd3fe361-8754-4dfa-ab4b-aae2af9de82f';
        $uuid = new UUID($uuid_raw);
        expect($uuid->jsonSerialize())->toBe($uuid_raw);
    });

    test('->value', function () {
        $uuid_raw = 'fd3fe361-8754-4dfa-ab4b-aae2af9de82f';
        $uuid = new UUID($uuid_raw);
        expect($uuid->value)->toBe($uuid_raw);
    });
});
