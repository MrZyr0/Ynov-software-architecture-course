<?php
define("PROJECT_ROOT", __DIR__);
define("DATABASE_FOLDER", PROJECT_ROOT . '/DB');

require 'vendor/autoload.php';

use App\Helpers\DemoHelper;
use App\Utils\HTMLPrinter;

HTMLPrinter::heading('My software architecture course at Ynov', 1);

DemoHelper::demoPrinter();
