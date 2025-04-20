<?php

/*
 * This file is part of the EPHPIC packages.
 *
 * (c) Sina Kuhestani <sinakuhestani@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EPHPIC\Autoload;

use RecursiveIteratorIterator as RecursiveIterator;
use RecursiveDirectoryIterator as DirectoryIterator;

final class Autoloader
{
    /**
     * Root directory
     * @var string
     */
    private static $root;

    /**
     * Holds all namespaces
     * @var array
     */
    private static $map = [];

    /**
     * Register root path for autoload.
     *
     * This method scans the provided root directory for `.autoload.ini` files
     * and registers the namespaces found within them for autoloading.
     *
     * @param string $root The root directory for autoloading classes.
     * @return void
     */
    public static function register($root)
    {
        static::$root = $root;
        // Create a RecursiveDirectoryIterator
        $iterator = new RecursiveIterator(new DirectoryIterator($root));

        // Iterate through all files
        foreach ($iterator as $file)
        {
            if ($iterator->getDepth() > 3 || $file->isDir())
            {
                // Skip directories and files beyond max depth
                continue;
            }

            // Check if the file is named ".autoload.ini"
            if ($file->isFile() && $file->getFilename() === '.autoload.ini')
            {
                // Get the full path of the file
                $file = $file->getPathname();
                // load .autoload.ini
                $data = parse_ini_file($file, true);
                // get directory path
                $directory = dirname($file);

                // get namespaces from file data and write is static::$map
                if (isset($data["namespaces"]))
                {
                    foreach ($data["namespaces"] as $namespace => $dir)
                    {
                        static::$map[$namespace] = "$directory/$dir";
                    }
                }
            }
        }
        // register autoload
        spl_autoload_register([static::class, "load"]);
    }

    /**
     * Load classes automatically.
     *
     * This method attempts to load the specified class by resolving its namespace
     * and including the corresponding file if it exists.
     *
     * @param string $class The fully qualified class name to load.
     * @return void
     */
    public static function load($class)
    {
        $root = static::$root;
        $path = explode("\\", $class);

        while (0 < count($path))
        {
            $key = implode("\\", $path);
            if (isset(static::$map[$key]))
            {
                $root = static::$map[$key];
                $class = str_replace([$key, "\\"], ["", "/"], $class);
                break;
            }
            array_pop($path);
        }

        $file = "$root$class.php";

        if (file_exists($file))
        {
            include_once $file;
        }
    }

    /**
     * Test if autoload is configured correctly.
     *
     * @return void
     */
    public static function test()
    {
        HelloWorld::render();
    }
}