<?php

namespace App;

use Exception;
use PDO;


class DB_Connection {
    private static $instance = null;
    private $pdo = null;

    private function __construct()
    {
        try{
            self::$pdo = new PDO('sqlite:'.dirname(__FILE__).'/database.sqlite');
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getInstance(): DB_Connection
    {
        if(self::$instance == null) {
            self::$instance = new DB_Connection();
        }
        return self::$instance;
    }
}
