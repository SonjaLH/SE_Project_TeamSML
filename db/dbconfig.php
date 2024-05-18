<?php

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            self::$connection = new mysqli('localhost', 'root', '', 'cardb');
            if (self::$connection->connect_error) {
                die('Cannot connect to db: ' . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}

?>
