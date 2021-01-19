<?php
define("PROJECT_ROOT", __DIR__);

require 'vendor/autoload.php';

use App\Helpers\DemoHelper;

DemoHelper::singleton();
