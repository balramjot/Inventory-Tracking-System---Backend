<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=itsdb';                                      // database url and name
    private static $username = 'cs602_user';                                                        // username for database
    private static $password = 'cs602_secret';                                                      // password for database

    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('./errors/database_error.php');                                                             // error page in case of exception
                exit();
            }
        }
        return self::$db;
    }
}

session_start();
?>