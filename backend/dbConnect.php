<?php
session_start();

class Database
{
    private static $conn = null;

    public static function connect()
    {
        if (self::$conn === null) {
            $host = '127.0.0.1';
            $db = 'banksystem';
            $user = 'banksystem';
            $pass = 'CACjfsTZek2WB4Y0QhMe';
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
