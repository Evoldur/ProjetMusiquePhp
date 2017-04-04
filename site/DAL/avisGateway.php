<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 08/01/2017
 * Time: 14:55
 */
class avisGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function insert($pseudo,$nom,$avis)
    {

        $query = 'INSERT INTO avis VALUES (:pseudo,:nom,:typeavis)';
        $this->con->executeQuery($query,array(':pseudo' =>array($pseudo,PDO::PARAM_STR),
                                              ':nom'    =>array($nom,PDO::PARAM_STR),
                                              ':typeavis'   =>array($avis,PDO::PARAM_STR)));
    }

    public function select($pseudo, $nom){
        $query = 'SELECT typeavis FROM avis WHERE pseudo = :pseudo AND nom = :nom';
        $this->con->executeQuery($query,array(':pseudo'=>array($pseudo,PDO::PARAM_STR),
                                              ':nom'   =>array($nom,PDO::PARAM_STR)));
        $res = $this->con->getResult();
        if($res == null){
            return null;
        }
        else{
            return $res;
        }
    }

    public function update($pseudo, $nom, $avis){
        $query = 'UPDATE avis SET typeavis = :avis WHERE pseudo = :pseudo AND nom = :nom';
        $this->con->executeQuery($query,array(':pseudo' =>array($pseudo,PDO::PARAM_STR),
                                              ':nom'    =>array($nom,PDO::PARAM_STR),
                                              ':avis'   =>array($avis,PDO::PARAM_STR)));
    }
}