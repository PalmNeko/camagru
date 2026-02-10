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
});
