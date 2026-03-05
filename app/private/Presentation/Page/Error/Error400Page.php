<?php

namespace PalmNeko\Camagru\Presentation\Page\Error;

class Error400Page
{
    public static function set() {
        http_response_code(400);
    }
}
