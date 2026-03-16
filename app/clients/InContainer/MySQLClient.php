<?php

namespace PalmNeko\Camagru\Client\InContainer;

use mysqli;

class MySQLClient
{
    static private mysqli $client;

    static public function staticClient()
    {
        if (!isset(self::$client)) {
            self::$client = new mysqli(
                hostname: "mariadb",
                username: "camagru",
                password: "password",
                database: "camagru",
                port: 3306
            );
        }
        return self::$client;
    }

    public function getClient()
    {
        return self::staticClient();
    }
}
