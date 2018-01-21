<?php
namespace Framework;

require_once 'renderer.php';

class View
{
    private static $renderer;

    public function __construct()
    {
        self::$renderer = new \Framework\Renderer();
    }

    public function render($template_name, $model = ['title' => 'Title'])
    {
        return [
            'rendition' => self::$renderer->render($template_name, $model),
            'model' => $model,
        ];
    }
}
