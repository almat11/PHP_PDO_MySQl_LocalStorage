<?php 

require_once 'DB.php';
require_once 'PHPDB.php';

class DatabaseFactory {
    static function Access(string $type): object {
        if ($type == "PHPDB") {
            return new PHPDB("mydatabase.db");
        } elseif ($type == "DB") {
            return new DB("mysql:host=localhost;dbname=gruppe18", "root", "");
        } else {
            throw new Exception("Lesen Sie bitte die Dokumentation!");
        }
    }
}

?>