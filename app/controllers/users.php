<?php
namespace Component;

class Users
{
    public function get($id, $p)
    {
        return $id . ' - ' . $p;
    }
}
