<?php


class Database 
{
    protected $pdo;
    public function __construct($config)
    {
        $dsn = "mysql:".http_build_query($config, "", ";");
        
        $this->pdo = new PDO($dsn);
    }
    
    public function query ($query, $params = [])
    {

        $pdoStatement = $this->pdo->prepare($query);

        $pdoStatement->execute($params);

        return $pdoStatement;
    }
}