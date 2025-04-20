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

/**
 * Class HelloWorld
 *
 * A simple class to demonstrate the functionality of the EPHPIC Autoloader.
 */
class HelloWorld
{
    /**
     * Render a greeting message.
     *
     * This static method outputs a "Hello World!" message along with a 
     * confirmation that the EPHPIC Autoload has been configured correctly.
     *
     * @return void
     */
    public static function render()
    {
        echo <<<EOT
        <h1>Hello World!</h1>
        <p>Congratulations! You have configured EPHPIC Autoload correctly.</p>
        EOT;
    }
}
