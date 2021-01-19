<?php
require 'vendor/autoload.php';

use App\DatabaseManager;
use App\PostManager;

$pdo = DatabaseManager::getPdoInstance();

PostManager::init();
PostManager::importDefaultData();
$posts = PostManager::getAllPosts();

echo '<pre>';
var_dump($posts);
echo '</pre>';

$post_0 = PostManager::getPostById("0");

echo '<pre>';
var_dump($post_0);
echo '</pre>';
