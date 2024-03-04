<?php

class DB
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "food";

    public function connect()
    {
        $dsn = "mysql:host=$this->servername;dbname=$this->dbname";
        $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        try {
            return new \PDO($dsn, $this->username, $this->password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

?>