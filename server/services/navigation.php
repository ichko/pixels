<?php
namespace Services;

class NavigationService
{
    public function __construct($append = '')
    {
        $this->append = $append;
    }

    public function navigate_to($url)
    {
        header("Location: $url" . DIRECTORY_SEPARATOR . "$append");
        exit();
    }
}
