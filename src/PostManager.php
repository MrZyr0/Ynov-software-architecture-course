<?php


namespace App;


use PDOStatement;

abstract class PostManager
{
    const TABLE_NAME = 'posts';


    /**
     * Create posts table
     *
     * @return PDOStatement|false <b>PDOStatement</b> on success or <b>FALSE</b> on failure.
     */
    public static function init(): PDOStatement
    {
        $pdo = DatabaseManager::getPdoInstance();

        return $pdo->query(sprintf("CREATE TABLE IF NOT EXISTS %s (
                                 id            INTEGER         PRIMARY KEY AUTOINCREMENT,
                                 title         VARCHAR( 250 ),
                                 created       DATETIME
                             );
        ", self::TABLE_NAME));
    }

    /**
     * Import default data into posts table
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public static function importDefaultData(): bool
    {
        $pdo = DatabaseManager::getPdoInstance();

        $stmt = $pdo->prepare("INSERT INTO posts (title, created) VALUES (:title, :created)");

        return $stmt->execute([
            'title' => "Lorem ipsum",
            'created' => date("Y-m-d H:i:s")
        ]);
    }

    /**
     * Request all Posts stored in database
     *
     * @return mixed The return value of this function on success depends on the fetch type. In
     * all cases, <b>FALSE</b> is returned on failure.
     */
    public static function getAllPosts()
    {
        $pdo = DatabaseManager::getPdoInstance();

        $statement = $pdo->query("SELECT * FROM posts;");

        return $statement->fetchAll();
    }

    /**
     * Request specific Post stored in database
     *
     * @param string $id
     * @return mixed The return value of this function on success depends on the fetch type. In
     * all cases, <b>FALSE</b> is returned on failure.
     */
    public static function getPostById(string $id)
    {
        $pdo = DatabaseManager::getPdoInstance();

        $statement = $pdo->query(sprintf("SELECT * FROM posts WHERE ID = %s", $id));

        return $statement->fetchAll();
    }
}