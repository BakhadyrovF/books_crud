<?php

namespace app\core;


class Database 
{
    public \PDO $pdo;

    public function __construct($config)
    {
        $tableName = $config["tableName"];
        $dbName = $config["dbName"];
        $this->pdo = new \PDO("mysql:host=127.0.0.1;port=3306;dbname=crud_app", "root", "mypass");
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->createTable($tableName);
    }

    public function createTable($tableName)
    {
        $statement = $this->pdo->prepare(
            "CREATE TABLE IF NOT EXISTS $tableName 
            (id INT PRIMARY KEY AUTO_INCREMENT, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, price INT NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)
            ");
        $statement->execute();
    }

    
}






?>