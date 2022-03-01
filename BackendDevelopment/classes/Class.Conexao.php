<?php

// LOCALHOST Version

define('HOST'       , 'localhost:3306'  );
define('DBNAME'     , 'dbtg2022'        );
define('USER'       , 'root'            );
define('PASSWORD'   , 'root'            );

// WEB Version

// define('HOST'       , 'us-cdbr-east-04.cleardb.com' );
// define('DBNAME'     , 'heroku_f8611d16df426e6'      );
// define('USER'       , 'bc5758a825e4d6'              );
// define('PASSWORD'   , 'aa7c67cc'                    );
 
class ConexaoDB
{
    private static $pdo;
 
    // private function __construct(){}
 
    public static function getConexao()
    {
        if (!isset(self::$pdo)) {
            $opt = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' ];
            self::$pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASSWORD,$opt);
        }
        return self::$pdo;
    }
}