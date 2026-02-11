<?php

use PalmNeko\Camagru\Presentation\Http\URL;

describe("URL", function () {
    // describe("::parse()", function() {

    // });
    test("->protocol", function () {
        $url = new URL('https://test.com');
        $suffix = ':';
        $https_protocol = "https$suffix";

        // can assign
        $url->protocol = 'ftp:';
        expect($url->protocol)->toBe("ftp$suffix");

        // ignore empty
        $url->protocol = $https_protocol;
        $url->protocol = '';
        expect($url->protocol)->toBe($https_protocol);

        // auto append suffix
        $url->protocol = 'http';
        expect($url->protocol)->toBe("http$suffix");

        // ** Caution ** accept incorrect format
        $url->protocol = $https_protocol;
        $url->protocol = 'http:asdf';
        expect($url->protocol)->toBe("http:asdf$suffix");
    });

    test("->port", function () {
        $url = new URL('https://test.com');

        $url->port = '';
        expect($url->port)->toBe('');

        $url->port = 321;
        expect($url->port)->toBe('321');

        $url->port = 8080;
        $url->port = "abc";
        expect($url->port)->toBe('8080');
    });

    test("->pathname", function () {
        $url = new URL('https://test.com');

        $url->pathname = '';
        expect($url->pathname)->toBe('/');

        $url->pathname = 'abc';
        expect($url->pathname)->toBe('/abc');

        $url->pathname = '/hoge';
        expect($url->pathname)->toBe('/hoge');
    });

    test("->search", function() {
        $url = new URL('https://test.com?hoge');
        expect($url->search)->toBe('?hoge');

        $url->search = '';
        expect($url->search)->toBe('');

        $url->search = '?';
        expect($url->search)->toBe('');

        $search = '?tarou=321&hoge=321';
        $url->search = $search;
        expect($url->search)->toBe($search);

        $search = 'hogehoge';
        $url->search = $search;
        expect($url->search)->toBe("?$search");
    });

    test("->hash", function() {
        $url = new URL('https://test.com#code');
        expect($url->hash)->toBe('#code');

        $url->hash = '';
        expect($url->hash)->toBe('');

        $url->hash = '#';
        expect($url->hash)->toBe('');

        $hash = '#code';
        $url->hash = $hash;
        expect($url->hash)->toBe($hash);

        $hash = 'hogehoge';
        $url->hash = $hash;
        expect($url->hash)->toBe("#$hash");
    });

    test("->href", function() {
        $url = new URL('https://user:pass@test.com?tarou#hoge');
        expect($url->href)->toBe('https://user:pass@test.com/?tarou#hoge');
    });
});
