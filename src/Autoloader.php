<?php

namespace EPHPIC\Autoload;

final class Autoloader
{
    private static $root;
    private static $map = [];
    public static function register($root)
    {
        static::$root = $root;
        $files = [];

        // Create a RecursiveDirectoryIterator
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root));

        // Iterate through all files
        foreach ($iterator as $file)
        {
            if ($iterator->getDepth() > 32 || $file->isDir())
            {
                continue; // Skip directories and files beyond max depth
            }
            // Check if the file is named ".autoload.ini"
            if ($file->isFile() && $file->getFilename() === '.autoload.ini')
            {
                $file = $file->getPathname(); // Get the full path of the file
                $directory = dirname($file);
                $data = parse_ini_file($file, true);
                if (isset($data["namespaces"]))
                {
                    foreach ($data["namespaces"] as $namespace => $dir)
                    {
                        static::$map[$namespace] = "$directory/$dir";
                    }
                }
            }
        }
        spl_autoload_register([static::class, "load"]);
    }
    public static function load($class)
    {
        $dir = static::$root;
        $path = explode("\\", $class);
        while (0 < count($path))
        {
            $key = implode("\\", $path);
            if (isset(static::$map[$key]))
            {
                $dir = static::$map[$key];
                $class = str_replace([$key, "\\"], ["", "/"], $class);
                break;
            }
            array_pop($path);
        }
        $file = "$dir$class.php";
        if (@file_exists($file))
        {
            include_once $file;
        }
    }
}