<?php
require 'vendor/autoload.php';

use App\DB_Connection;

$connect = DB_Connection::getInstance();

var_dump($connect);
