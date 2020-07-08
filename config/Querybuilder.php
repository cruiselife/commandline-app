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

    /**
     * @param $table
     * @return array
     */
    public function selectAll($table): array
    {
        $statement  = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}