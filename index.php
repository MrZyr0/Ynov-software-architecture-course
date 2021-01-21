<?php
define("PROJECT_ROOT", __DIR__);
define("DATABASE_FOLDER", PROJECT_ROOT . '/DB');

require 'vendor/autoload.php';

use App\Helpers\DemoHelper;

//DemoHelper::singleton();

DemoHelper::factory();