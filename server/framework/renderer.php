<?php
namespace Framework;

require_once 'config.php';

class Renderer
{
    public $templates_root = Config::templates_root;
    public $template_ext = Config::templates_ext;

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
