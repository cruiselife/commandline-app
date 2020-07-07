<?php
namespace Config\builder;


class Querybuilder{

    protected $pdo;

    public function __construct(PDO $pdo)
    {

        var_dump($pdo);
        $this->pdo = $pdo;
    }

    public function selectAll($table){
        $statement  = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($data, $table){

        $insertQuery = "insert into {$table} (description, completed) values ('".$data['description']. "', 0)";
        
        $statement  = $this->pdo->prepare($insertQuery);

        $statement->execute();

       // return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
    }
}