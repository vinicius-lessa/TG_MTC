<?php

// LOCALHOST Version

// define('HOST'       , 'localhost:3306'  );
// define('DBNAME'     , 'dbtg2022'        );
// define('USER'       , 'root'            );
// define('PASSWORD'   , 'root'            );

// WEB Version (HEROKU)

define('HOST'       , 'us-cdbr-east-05.cleardb.net' );
define('DBNAME'     , 'heroku_916450fc20755ea'      );
define('USER'       , 'b158a4653ac7fe'              );
define('PASSWORD'   , '1b408bbf'                    );
 
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