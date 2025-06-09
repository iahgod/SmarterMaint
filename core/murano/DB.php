<?php

namespace core\murano;

use \src\Config;
use \core\Database;


Class DB{

    protected static $h;
    
    public function __construct() {
        self::tabela();
    }

    public static function tabela(){

        $connection = Database::getInstance();
        
        $connection->exec("SET time_zone = '-03:00'");
        
        self::$h = new \ClanCats\Hydrahon\Builder('mysql', function($query, $queryString, $queryParameters) use($connection)
        {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);

            if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
            {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }

            elseif($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
            {
                return $connection->lastInsertId();
            }

            else 
            {
                return $statement->rowCount();
            }	

        });

    }

    public static function table($table) {
        self::tabela();
        return self::$h->table($table);
    }
    public static function lastId($table) {
        self::tabela();
        return self::$h->table($table)->select('id')->orderBy('id', 'desc')->one();
    }

    public static function select($query, $params = []) {
        $conn = new \PDO("mysql:host=localhost;dbname=" . Config::DB_DATABASE, Config::DB_USER, Config::DB_PASS);
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}