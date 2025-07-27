# TestPackage

A Laravel package for managing Shopify orders. This package provides a model and basic functionality for interacting with Shopify order data.

## Features

- Model for managing Shopify orders.
- Configurable table name and database connection.
- Easy integration with Laravel projects.

## Installation

You can install the package via Composer. Run the following command in your Laravel project:

```bash
composer require leaiserneo/testpackage
Publishing Configuration
After installing the package, you may publish the configuration file to customize settings:

bash
php artisan vendor:publish --provider="Leaiserneo\TestPackage\PackageServiceProvider" --tag=config
This will copy the configuration file to config/testpackage.php where you can adjust the table name and database connection settings.

Configuration
In the config/testpackage.php file, you can configure the model settings:
 
return [
    'models' => [
        'shopify_orders' => 'shopify_orders_table_name',
    ],
    'connection' => env('TESTPACKAGE_DB_CONNECTION', 'testpackage_connection'),
];
Make sure to define the testpackage_connection in your config/database.php file:
 
'connections' => [
    'testpackage_connection' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'testpackage_database'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ],
],
Usage
To use the ShopifyOrder model provided by this package, simply interact with it as you would with any Eloquent model:
 
use Leaiserneo\TestPackage\Models\Shopify\ShopifyOrder;

// Retrieve all Shopify orders
$orders = ShopifyOrder::all();

// Retrieve a single Shopify order by ID
$order = ShopifyOrder::find(1);
Testing
You can run tests for this package by navigating to the package directory and running:

bash 
php artisan test
License
This package is open-source and licensed under the MIT License.

Contributing
Feel free to contribute to this package by submitting issues or pull requests. Please ensure that you follow the coding standards and write tests for your changes.

Contact
For any questions or issues, please contact Leaiserneo.
  
### Notes:

- **Replace placeholder values** with actual information related to your package.
- **Ensure your package's features, configuration, and usage examples** are accurately described.
- **Include additional sections** such as "Contributing" or "Contact" if relevant to your project.

This template should provide a solid starting point for your `README.md` and help others understand how to install and use your package.