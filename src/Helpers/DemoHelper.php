<?php


namespace App\Helpers;



use App\Managers\PostManager;
use App\Utils\HTMLPrinter;

abstract class DemoHelper
{
    public static function singleton()
    {
        PostManager::init();

        for ($index = 0; $index < 10; $index++) {
            PostManager::insertOneExamplePost();
        }
        $posts = PostManager::getAllPosts();

        HTMLPrinter::dump($posts);


        $post_0 = PostManager::getPostById("1");

        HTMLPrinter::dump($post_0);
    }
}
