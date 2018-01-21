<?php
namespace Framework;

require_once 'renderer.php';

class ViewRenderer extends Renderer
{
    public function render_view($layout_name, $method_name, $view_data)
    {
        $model = [];
        $template_name = $method_name;
        $title = 'Title';

        if (array_key_exists('model', $view_data)) {
            $model = $view_data['model'];
        }
        if (array_key_exists('template', $view_data)) {
            $template_name = $view_data['template'];
        } else {
            $model = $view_data;
        }
        if (array_key_exists('title', $model)) {
            $title = $model['title'];
        }

        return parent::render($layout_name, [
            'content' => parent::render($template_name, $model),
            'title' => $title,
        ]);
    }
}
