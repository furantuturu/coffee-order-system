<?php

class Database {
    private $connection;
    private $statement;
    public function __construct() {
        try {
            $this->connection = new \PDO("mysql:host=localhost;dbname=ordersys;port=3306","root","chunchunmaru", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::FETCH_DEFAULT => PDO::FETCH_ASSOC
            ]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $query, array $params = []) {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }
    


    public function getAll() {
        return $this->statement->fetchAll();
    }
}