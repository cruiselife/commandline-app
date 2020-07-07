<?php
namespace Config\builder;

use Config\Connect\Connection;
use \PDO;

class Querybuilder{

    protected $pdo;

    public function __construct()
    {

        $this->pdo = Connection::make();

    }

    public function selectAll($table){
        $statement  = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data, $table){

        $insertQuery = "insert into {$table} (description, completed) values ('".$data['description']. "', 0)";
        
        $statement  = $this->pdo->prepare($insertQuery);

        $statement->execute();

       // return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
    }
}