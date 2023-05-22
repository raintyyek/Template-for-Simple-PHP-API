# Template for Simple PHP API

This is a template for Simple PHP API. The Supported DBMS for this template is MySQL

**Author:** [Rainty Yek](https://github.com/raintyyek)

**License:** MIT


# Setup
Copy content of inc/Config.example.php to inc/Config.php. And then replace Database Configs with your own DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE

```php
<?php 
    /**
     * API Configs
    */
    define("VALIDATE_WITH_KEY", false);
    define("ENCRYPT_KEY", "XXXXXXXXXXX");

    /**
     * Database config variables
    */
    define("DB_HOST", "XXXXXXXX");
    define("DB_USER", "XXXXXXXX");
    define("DB_PASSWORD", "XXXXXXX");
    define("DB_DATABASE", "XXXXXXX");
?>
```