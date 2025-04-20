<?php

use EPHPIC\Autoload\Autoloader;

$ds = DIRECTORY_SEPARATOR;

// Require the Autoloader class file
require __DIR__ . $ds . "src" . $ds . "Autoloader.php";

/**
 * Define the ROOT constant.
 *
 * This constant represents the root directory of the project. It is defined
 * only if it hasn't been defined previously.
 */
if (!defined("ROOT"))
{
    define("ROOT", dirname(__DIR__, 2));
}

/**
 * Register the Autoloader with the defined ROOT directory.
 *
 * This call initializes the autoloading mechanism using the ROOT directory
 * to locate class files.
 *
 * @return void
 */
Autoloader::register(ROOT);
