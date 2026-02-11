<?php

namespace PalmNeko\Camagru\Presentation\Page;

use PalmNeko\Camagru\Presentation\Http\{
    IRequestHandler,
    HandlerResult,
};

use PalmNeko\Camagru\Presentation\Templates\{
    AppBase
};

class Gallery implements IRequestHandler {
    public function invoke(): HandlerResult {
        $template = new AppBase('Camagru', 'Hello World');
        echo $template->render_template();
        http_response_code(200);
        return new HandlerResult(false);
    }
}
