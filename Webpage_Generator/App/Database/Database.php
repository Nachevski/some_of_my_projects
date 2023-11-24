<?php
declare(strict_types=1);

namespace App\Database;

use PDO;
use PDOException;
use const App\Database\Config\DB_HOST;
use const App\Database\Config\DB_NAME;
use const App\Database\Config\DB_PASSWORD;
use const App\Database\Config\DB_USERNAME;

class Database
{
    protected static \PDO|null $instance = null;

    public function __construct()
    {
        try {
            self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function connect(): object
    {
        if (is_null(self::$instance)) {
            new self;
        }
        return self::$instance;
    }

    public static function terminateConnection()
    {
        self::$instance = null;
    }
}