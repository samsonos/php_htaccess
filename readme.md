#SamsonPHP module for automatic creating htaccess rules

##Using module in your project
To use SamsonPHP framework in your project you must add its dependency in your ```composer.json```:
```json
    "require": {
        "samsonos/php_htaccess": "1.*"
    }, 
```

For parsing e404 rules from your .txt file you must create configuration and call method error404()

Example usage:
```php
// Create configuration class
class HtaccessConfig extends \samson\core\Config
{
    public $__module = 'htaccesscreate';

    public $domain 	= 'example.com';
}

/*
*
*
*
*/

// Call parsing method
m('htaccesscreate')->error404('myfile.txt');
```

Developed by [SamsonOS](http://samsonos.com/)
