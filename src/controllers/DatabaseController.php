<?php

class DatabaseController {
    private static $conn = null;

    public static function connect(): PDO {
        if (self::$conn === null) {
            $host = 'host.docker.internal'; 
            $port = '5433';
            $dbname = 'db';
            $user = 'docker';
            $password = 'docker';

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

            try {
                self::$conn = new PDO($dsn, $user, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    } 
}
