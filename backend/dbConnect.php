<?php
session_start();

class Database
{
    private static $conn = null;

    public static function connect()
    {
        if (self::$conn === null) {
            $host = 'localhost';
            $db = 'banksystem';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            self::$conn = new PDO($dsn, $user, $pass, $options);
        }
        return self::$conn;
    }
}
