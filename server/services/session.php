<?php
namespace Services;

class SessionService
{
    public function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
    }

    public function destroy()
    {
        session_destroy();
    }
}
