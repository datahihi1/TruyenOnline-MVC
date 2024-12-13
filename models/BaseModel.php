<?php

class BaseModel
{
    protected $table;
    protected $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            die("Kết nối thất bại:".$e->getMessage());
        }
    }
    public function __destruct()
    {
        $this->pdo = null;
    }
}
