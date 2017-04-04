<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 07/12/2016
 * Time: 18:46
 */

class MusicGateway
{

    private $con;
    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function insert($nom, $couvertureAlbum,$dateMiseLigne,$avisFavorable,$avisNegatif,$avisIndifferent,$dureeEcoute)
    {
        $query = 'INSERT INTO music VALUES (:nom,:couvertureAlbum,:dateMiseLigne,:avisFavorable,:avisNegatif,:avisIndifferent,:dureeEcoute)';
        $this->con->executeQuery($query,array(':nom'            =>array($nom,PDO::PARAM_STR),
                                              ':couvertureAlbum'=>array($couvertureAlbum,PDO::PARAM_STR),
                                              ':dateMiseLigne'  =>array($dateMiseLigne,PDO::PARAM_STR),
                                              ':avisFavorable'  =>array($avisFavorable,PDO::PARAM_INT),
                                              ':avisNegatif'    =>array($avisNegatif,PDO::PARAM_INT),
                                              ':avisIndifferent'=>array($avisIndifferent,PDO::PARAM_INT),
                                              ':dureeEcoute'    =>array($dureeEcoute,PDO::PARAM_STR)));
    }

    public function count(){
        $query = 'SELECT COUNT(*) FROM music';
        $this->con->executeQuery($query, array());
        return $this->con->getResult();
    }

    public function select()
    {
        $query = 'SELECT * FROM music ORDER BY avisFavorable DESC';
        $this->con->executeQuery($query, array());
        $res = $this->con->getResult();
        if($res != NULL){
            return $res;
        }
    }

    public function selectAvis($nomMusique){
        $query = 'SELECT avisFavorable, avisNegatif, avisIndifferent FROM music WHERE nom=:nom';
        $this->con->executeQuery($query, array(':nom'=>array($nomMusique,PDO::PARAM_STR)));
        return $this->con->getResult();
    }

    public function selectDetail($nomMusique){
        $query = 'SELECT * FROM music WHERE nom = :nom';
        $this->con->executeQuery($query, array(':nom'   =>array($nomMusique,PDO::PARAM_STR)));

        return $this->con->getResult();
    }

    public function update($nomMusique, $avisFav, $avisDefav, $avisNeutre){
        $query ='UPDATE music SET avisFavorable= :avisFav, avisNegatif= :avisDefav, avisIndifferent = :avisNeutre WHERE nom = :nom';
        $this->con->executeQuery($query, array(':avisFav'   => array($avisFav,PDO::PARAM_INT),
                                               ':avisDefav' => array($avisDefav,PDO::PARAM_INT),
                                               ':avisNeutre'=> array($avisNeutre,PDO::PARAM_INT),
                                               ':nom'       => array($nomMusique,PDO::PARAM_STR)));
    }

    public function delete($nom)
    {
        $query = 'DELETE FROM music WHERE(nom = :nom)';
        $this->con->executeQuery($query,array(':nom' =>array($nom,PDO::PARAM_STR)));
    }
}