<?php

declare(strict_types=1);

require __DIR__ . '/../private/environments.php';

use PalmNeko\Camagru\App;

$app = new App();

$result = $app->invoke();
if ($result->isNext())
    phpinfo();
