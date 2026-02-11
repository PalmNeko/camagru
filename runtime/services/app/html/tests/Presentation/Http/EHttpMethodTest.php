<?php

use PalmNeko\Camagru\Presentation\Http\EHttpMethod;

pest()->group('EHttpMethod');

describe('EHttpMethod', function () {
    test('::from_string', function () {
        expect(EHttpMethod::from_string('GET'))->toBe(EHttpMethod::Get);
        expect(EHttpMethod::from_string('POST'))->toBe(EHttpMethod::Post);
        expect(EHttpMethod::from_string('PUT'))->toBe(EHttpMethod::Put);
        expect(EHttpMethod::from_string('DELETE'))->toBe(EHttpMethod::Delete);
        expect(EHttpMethod::from_string(''))->toBe(null);
        expect(EHttpMethod::from_string('HEAD'))->toBe(null);
        expect(EHttpMethod::from_string('CONNECT'))->toBe(null);
        expect(EHttpMethod::from_string('OPTIONS'))->toBe(null);
        expect(EHttpMethod::from_string('TRACE'))->toBe(null);
        expect(EHttpMethod::from_string('PATCH'))->toBe(null);
    });
});
