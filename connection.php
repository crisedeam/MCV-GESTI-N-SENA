<?php

class Db{
    private static $host="localhost";
    private static $dbname="ProgSENA";
    private static $user="root";
    private static $pass="";
    private static $charset="utf8mb4";

    public static function getConnect(){
        try{
            $connection = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";charset=".self::$charset, self::$user, self::$pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $e){
            echo "Connection error: " . $e->getMessage();
        }
    }
}