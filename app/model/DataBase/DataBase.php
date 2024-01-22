<?php

namespace App\Model\DataBase;

class DataBase
{
    // Data base properties
    private $host = 'localhost';
    private $port = '3306';
    protected $dbName = 'u968260774_delicor';
    private $username = 'u968260774_delicoradmin';
    private $password = 'sspxywn@|:A4';
    private $connection;

    protected function getConnection()
    {
        // Returns a database connection instance
        if (!isset($this->connection)) {
            try {
                // The dsn contains the information to connect to the database
                $dsn = "mysql:host = $this->host; dbname = $this->dbName; port = $this->port";
                // Associates a database connection instance with this->connection
                // The records are retrieved as an object
                $this->connection = new \PDO($dsn, $this->username, $this->password, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]);
            } catch (\PDOException $e) {
                throw new \Exception('Connection failed: ' . $e->getMessage());
            }
        }
        return $this->connection;
    }
}
