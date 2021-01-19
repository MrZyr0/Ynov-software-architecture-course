<?php

namespace App\Managers;

use PDO;


class DatabaseManager
{
    /**
     * App's PDO global instance
     *
     * @var PDO|null
     */
    private static ?PDO $pdo_instance = null;

    /**
     * DatabaseManager constructor.
     */
    private function __construct()
    {
        // Constructor is useless here
    }

    /**
     * Get App's PDO global instance
     *
     * @return PDO
     */
    public static function getPdoInstance(): PDO
    {
        if (self::$pdo_instance == null) {
            if (!is_dir(DATABASE_FOLDER))
                mkdir(DATABASE_FOLDER);

            $pdo = new PDO('sqlite:' . DATABASE_FOLDER . '/database.sqlite');
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT

            self::$pdo_instance = $pdo;
        }
        return self::$pdo_instance;
    }
}
