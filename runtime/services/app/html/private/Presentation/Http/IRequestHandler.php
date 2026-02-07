<?php

namespace PalmNeko\Camagru\Presentation\Http;

interface IRequestHandler
{
    public function invoke(): HandlerResult;
}
