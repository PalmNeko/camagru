<?php
declare(strict_types=1);

# autoload
require __DIR__ . '/../vendor/autoload.php';

# error to exception
set_error_handler(
    function ($severity, $message, $filename, $lineno) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
);
