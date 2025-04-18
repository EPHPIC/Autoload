<?php

use EPHPIC\Autoload\Autoloader;

require __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Autoloader.php";

if (!defined("ROOT"))
{
    define("ROOT", dirname(__DIR__, 2));
}

Autoloader::register(ROOT);