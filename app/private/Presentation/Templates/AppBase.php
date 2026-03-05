<?php

namespace PalmNeko\Camagru\Presentation\Templates;

class AppBase extends Template
{
    public function __construct(
        public string $title,
        public string $content,
    ) {
        parent::__construct(__DIR__ . '/app-base.php');
    }
}
