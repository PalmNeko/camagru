<?php

namespace PalmNeko\Camagru\Presentation\Page\Error;

class Error404Page
{
    public static function set() {
        http_response_code(404);
    }
}
