<?php

namespace PalmNeko\Camagru;

use PalmNeko\Camagru\Presentation\API\Images\GetAllImages;
use PalmNeko\Camagru\Presentation\Http\{
    RequestRouter,
    RequestHandlerRule,
    HandlerResult,
    IRequestHandler,
};

use PalmNeko\Camagru\Presentation\Page\{
    Gallery,
};

class App implements IRequestHandler
{
    public function invoke(): HandlerResult
    {
        $router = new RequestRouter();
        $router->appendRule(RequestHandlerRule::get('/^\/gallery\/?$/', new Gallery()));
        $router->appendRule(RequestHandlerRule::get('/^\/api\/gallery$/', new GetAllImages()));

        return $router->invoke();
    }
}
