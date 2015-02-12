<?php

Class Database {

    private static $db;

    public static function getInstance() {
        if (!self::$db) {
            self::$db = new PDO('mysql:host=localhost;dbname=sklep;charset=utf8', 'root', '');
            return new Database();
        }
    }
}

?>