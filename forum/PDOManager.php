<?php
declare(strict_types=1);


class PDOManager
{
    protected $pdo;
    protected static $instance;

    private function __construct()
    {
        try {
            $this->pdo = new PDO ('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
            array
            (
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci'
            );
        } catch (PDOException $e) {
            die(utf8_encode($e->getMessage()));
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }



    public static function getInstance(): PDOManager
    {
        if (self::$instance === null)
        {
            self::$instance = new PDOManager();
        }

        return self::$instance;
    }

}