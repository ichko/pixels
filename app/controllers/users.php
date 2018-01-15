<?php
namespace Controllers;

class Users
{
    public function get($id, $p)
    {
        return $id . ' - ' . $p;
    }
}
