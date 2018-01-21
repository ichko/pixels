<?php
namespace Framework;

class Renderer
{
    public function __constrict($templatesRoot)
    {
        $this->templatesRoot = $templatesRoot;
    }

    public function render($template_name, $model)
    {
        return function () use ($model) {
            require_once $this->templatesRoot . DIRECTORY_SEPARATOR . $template_name;
        };
    }
}
