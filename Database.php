<?php

class Database {
    private $connection;
    private $statement;
    public function __construct() {
        try {
            $this->connection = new \PDO("mysql:host=pglr3.h.filess.io;dbname=orderdb_wonderday;port=3307","orderdb_wonderday","36e1fcc9f4d39719bfe7dae07e032cdca79da4f5", [
                PDO::FETCH_DEFAULT => PDO::FETCH_ASSOC
            ]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}