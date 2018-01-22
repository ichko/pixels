<?php
namespace Framework\DB;

class Query
{
    public function __construct($connection, $sql)
    {
        $this->connection = $connection;
        $this->statement = $connection->prepare($sql);
    }

    public function get_last_id()
    {
        return $this->connection->lastInsertId();
    }

    public function bind_all($fields)
    {
        foreach ($fields as $key => &$val) {
            $this->statement->bindParam(":$key", $val);
        }

        return $this;
    }

    public function fetch($fetch_type = \PDO::FETCH_ASSOC)
    {
        return $this->statement->fetch($fetch_type);
    }

    public function execute()
    {
        $this->statement->execute();
        return $this;
    }
}

class MySqlConnection
{
    public function __construct($db_config)
    {
        $this->db_name = $db_config['db_name'];
        $this->connection = new \PDO(
            "mysql:host={$db_config['host']};dbname={$db_config['db_name']}",
            $db_config["username"],
            $db_config["password"]
        );
        $this->connection->query("SET NAMES utf8");
    }

    public function get_db_name()
    {
        return $this->db_name;
    }

    public function query($sql)
    {
        return new Query($this->connection, $sql);
    }
}
