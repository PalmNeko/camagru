<?php

use PalmNeko\Camagru\Presentation\Http\Headers;

describe('Headers', function () {
    test('->append()', function () {
        $headers = new Headers();

        $headers->append('Content-Type', 'application/json');
        $headers->append('Content-Type', 'text/html');
        expect($headers->get('Content-Type'))->toBe('application/json, text/html');
    });

    test('->has()', function () {
        $headers = new Headers();

        $headers->append('Content-Type', 'application/json');
        expect($headers->has('content-type'))->toBeTrue();
    });

    test('->set()', function () {
        $headers = new Headers();

        $headers->set('Content-Type', 'application/json');
        expect($headers->get('content-type'))->toBe('application/json');

        $headers->set('Content-Type', 'text/html');
        expect($headers->get('content-type'))->toBe('text/html');
    });

    test('->delete()', function () {
        $headers = new Headers();

        $headers->set('Content-Type', 'application/json');
        $headers->delete('Content-Type');
        expect($headers->get('content-type'))->toBe(null);
    });

    test('->entities()', function () {
        $headers = new Headers();

        $expect_headers = [
            'content-type' => 'application/json',
            'host' => 'localhost',
        ];
        foreach($expect_headers as $name => $value) {
            $headers->set($name, $value);
        }
        foreach($headers->entities() as $name => $value)
        {
            expect(key_exists($name, $expect_headers))->toBeTrue('must have header name');
            expect($expect_headers[$name])->toBe($value, 'equal value');
        }
    });
});
