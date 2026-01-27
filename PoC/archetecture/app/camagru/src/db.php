<?php

// こういうデフォルト設定の仕方は、ini_get()で取得できるので避けること。
ini_set("mysqli.default_host", "db");
ini_set("mysqli.default_user", "root");
ini_set("mysqli.default_pw", "example");
ini_set("mysqli.default_port", 3306);

// $mysqli = new mysqli("db", "root", "example", "mysql", 3306);
$mysqli = new mysqli("mysql");
echo $mysqli->host_info . "\n";
?>
