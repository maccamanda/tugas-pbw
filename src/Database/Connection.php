<?php
namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    private static $db;
    private static $host = '127.0.0.1';
    private static $dbname = 'test';
    private static $user = 'root';
    private static $password = '';

    private static function getDB()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit('Connection error: ' . $e->getMessage()); // lebih baik tampilkan error-nya saat dev
            }
        }
        return self::$db;
    }

    public static function query($query, $params = null)
    {
        $statement = self::getDB()->prepare($query);
        $statement->execute($params);

        $data = [];
        try {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
        } catch (PDOException $e) {
            exit('Query error: ' . $e->getMessage());
        }
        return $data;
    }
}
