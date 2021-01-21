<?php
define("PROJECT_ROOT", __DIR__);
define("DATABASE_FOLDER", PROJECT_ROOT . '/DB');

require 'vendor/autoload.php';

use App\Utils\HTMLPrinter;
use App\Helpers\DemoHelper;

HTMLPrinter::heading('My software architecture course at Ynov', 1);

DemoHelper::singleton();

DemoHelper::factory();