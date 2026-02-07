<?php

namespace PalmNeko\Camagru\Presentation\Http;

enum EHttpMethod: string
{
    case Get = 'GET';
    case Post = 'POST';
    case Put = 'PUT';
    case Delete = 'DELETE';

    public static function from_string($data) : ?self {
        return match(true) {
            strcasecmp("Get", $data) === 0 => self::Get,
            strcasecmp("Post", $data) === 0 => self::Post,
            strcasecmp("Put", $data) === 0 => self::Put,
            strcasecmp("Delete", $data) === 0 => self::Delete,
            default => null,
        };
    }
}
