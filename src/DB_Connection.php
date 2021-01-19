<?php

namespace App;

use PDO;


class DB_Connection {
    private static $instance = null;

    private function __construct()
    {
        try{
            self::$instance = new PDO('sqlite:'.dirname(__FILE__).'/database.sqlite');
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
