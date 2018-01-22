<?php
namespace Framework;

class Renderer
{
    public function __construct($templates_root, $template_ext)
    {
        $this->templates_root = $templates_root;
        $this->template_ext = $template_ext;
    }

    public function render($template_name, $model = [])
    {
        $template_path = $this->templates_root
        . DIRECTORY_SEPARATOR
        . $template_name
        . $this->template_ext;

        ob_start();
        require_once $template_path;
        $rendered_result = ob_get_contents();
        ob_end_clean();

        return $rendered_result;
    }
}
