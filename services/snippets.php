<?php
namespace Services;

class SnippetsService
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create()
    {
        $this->db->query("
            SELECT
        ")->execute()->get_last_id();
    }
}
