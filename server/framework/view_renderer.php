<?php
namespace Framework;

require_once 'renderer.php';

class ViewRenderer extends Renderer
{
    public function render_view($layout_name, $method_name, $view_data)
    {
        if (!array_key_exists('template_name', $view_data)) {
            $view_data['template_name'] = $method_name;
        }
        if (!array_key_exists('model', $view_data)) {
            $view_data['model'] = [];
        }
        if (!array_key_exists('title', $view_data['model'])) {
            $view_data['model']['title'] = 'Title';
        }

        return parent::render($layout_name, [
            'content' => parent::render($view_data['template_name'], $view_data['model']),
            'title' => $view_data['model']['title'],
        ]);
    }
}
