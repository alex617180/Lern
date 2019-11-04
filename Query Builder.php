<?php

use PDO;

class Db
{

    public $db;
    protected static $_instance;

    private function __construct()
    {
        $config = require 'db.php';

        // Создаём объект PDO, передавая ему следующие переменные:
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . ';charset=' . $config['charset'], $config['user'], $config['password'], $config['opt']);
    }

    // Singleton
    public static function getInstance()
    {

        if (self::$_instance === null)
            self::$_instance = new self;

        return self::$_instance;
    }

    private function __clone()
    { }
    private function __wakeup()
    { }
}

class Query Builder {

    public $pdo;

    public function __construct() {
        $this->pdo = Db::getInstance();
    }

    // подготовка запроса
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

// передача строки sql-запроса и $params, например ['id' => $id,]

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll();
    }
    public function rowObject($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
    public function fetch($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetch();
    }
    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
    //получение id последнего запроса:
    public function lastInsertId()
    {
        return $this->pdo->db->lastInsertId();
    }

}