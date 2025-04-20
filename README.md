# EPHPIC Autoload

## Overview

EPHPIC Autoload is a simple and efficient autoloader for PHP classes that leverages `.autoload.ini` configuration files to map namespaces to directories. This package helps streamline the process of including class files, making it easier to manage large applications with multiple namespaces.

## Features

- **Namespace Mapping**: Automatically registers namespaces from `.autoload.ini` files.
- **Directory Scanning**: Scans the specified root directory for configuration files.
- **Automatic Class Loading**: Loads classes on-demand based on their fully qualified names.

## Installation

To install the EPHPIC Autoload package, you can clone the repository or include it in your project manually.

### Cloning the Repository

```bash
git clone https://github.com/EPHPIC/Autoload.git
```

### Composer Installation

If you are using Composer, you can add it to your `composer.json`:

```json
{
    "require": {
        "EPHPIC/Autoload": "^1.0"
    }
}
```

Then run:

```bash
composer install
```

## Usage

To use the EPHPIC Autoload package, follow these steps:

1. **Create a `.autoload.ini` file** in your project directory with the following structure:

   ```ini
   [namespaces]
   YourNamespace = src/YourNamespace
   AnotherNamespace = src/AnotherNamespace
   ```

2. **Register the Autoloader** in your PHP script:

   ```php
   <?php

   require 'path/to/Autoloader.php';

   use EPHPIC\Autoload\Autoloader;

   // Register the autoloader with the root directory
   Autoloader::register(__DIR__);
   ```

3. **Load Your Classes**:

   Now you can use your classes without manually including them:

   ```php
   $object = new YourNamespace\YourClass();
   ```

## Testing

To test if the autoloading is configured correctly, you can call the `test` method:

```php
Autoloader::test();
```

This will invoke the `HelloWorld::render()` method, which outputs a confirmation message.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue if you find any bugs or have suggestions for improvements.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Author

(c) Sina Kuhestani <sinakuhestani@gmail.com>
