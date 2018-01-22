<?php
namespace Services;

class NavigationService
{
    public function __construct($append = '')
    {
        $this->append = $append;
    }

    public function navigate_to($extra)
    {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = rtrim($extra, '/\\');

        header("Location: http://$host$uri/$extra");
        exit;
    }
}
