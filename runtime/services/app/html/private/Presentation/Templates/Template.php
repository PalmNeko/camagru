<?php


namespace PalmNeko\Camagru\Presentation\Templates;

class Template
{
    public function __construct(
        public private(set) string $template_filename
    ) {}

    public function render_template(): string {
        if (is_file($this->template_filename)) {
            ob_start();
            include $this->template_filename;
            return ob_get_clean();
        }
        return '';
    }
}
