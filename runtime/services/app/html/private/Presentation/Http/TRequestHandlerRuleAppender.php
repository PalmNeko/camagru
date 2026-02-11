<?php

namespace PalmNeko\Camagru\Presentation\Http;

use PalmNeko\Camagru\Presentation\Page\Error\{
    Error400Page, Error404Page
};

trait TRequestHandlerRuleAppender
{
    public array $rules = [];

    public function appendRule(RequestHandlerRule $rule)
    {
        $this->rules[] = $rule;
    }

    public function invoke(): HandlerResult
    {
        $method = EHttpMethod::from_string($_SERVER['REQUEST_METHOD']);
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if ($method === null || $path === false || $path === NULL) {
            Error400Page::set();
            return new HandlerResult(false);
        }
        foreach ($this->rules as $rule) {
            if ($rule->isMatch($method, $path)) {
                return $rule->invoke();
            }
        }
        Error404Page::set();
        return new HandlerResult(false);
    }
}
