<?php

/**
 * Created by PhpStorm.
 * User: guforce
 * Date: 30/11/16
 * Time: 14:11
 */
class Connection extends PDO
{
    private $stmt;

    function __construct($dsn, $username, $passwd)
    {
        parent::__construct($dsn, $username, $passwd);
        $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    function executeQuery($query,array $parameters){
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name=>$value){
            $this->stmt->bindValue($name,$value[0],$value[1]);
        }
        return $this->stmt->execute();
    }

    function getResult(){
        return $this->stmt->fetchAll();
    }
}