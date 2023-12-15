<?php

class Bdd
{
    // Propriétés
    private $host = 'localhost';
    private $port = '3306';
    private $dbName = 'portfolio';
    private $username = 'root';
    private $password = '';
    private $connection;

    protected function getConnection()
    {
        // Retourne une instance de connexion à la base 
        if (!isset($this->connection)) {
            try {
                // Le dsn contient les informations pour se connecter à la base
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';port=' . $this->port;
                // Associe à this->connection une instance de connexion à la base, les enregistrements sont récupérés sous la forme d'un objet
                $this->connection = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $this->connection;
    }
}
