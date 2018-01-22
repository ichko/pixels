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
        if (!isset($db_config['host'])) {
            $db_config['host'] = 'localhost';
        }

        $this->connection = new \PDO(
            "mysql:host={$db_config['host']};dbname={$db_config['dbname']}",
            $db_config["username"],
            $db_config["password"]
        );
        $this->connection->query("SET NAMES utf8");
    }

    public function query($sql)
    {
        return new Query($this->connection, $sql);
    }
}
