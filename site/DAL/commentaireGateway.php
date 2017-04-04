<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 07/12/2016
 * Time: 23:26
 */
class commentaireGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function insert($id, $pseudo,$nom,$contenu, $dateParution)
    {
        $query = 'INSERT INTO commentaire VALUES (:idCom,:pseudo,:nom,:contenu,:dateParution)';
        $this->con->executeQuery($query,array('idCom'           =>array($id,PDO::PARAM_INT),
                                              ':pseudo'         =>array($pseudo,PDO::PARAM_STR),
                                              ':nom'            =>array($nom,PDO::PARAM_STR),
                                              ':contenu'        =>array($contenu,PDO::PARAM_STR),
                                              ':dateParution'   =>array($dateParution,PDO::PARAM_STR)));
    }

    public function selectNbCom($nom){
        $query = 'SELECT COUNT(*) FROM commentaire WHERE :nom =nom';
        $this->con->executeQuery($query, array(':nom' =>array($nom,PDO::PARAM_STR)));
        return $this->con->getResult();
    }

    public function select($nom)
    {
        $query = 'SELECT idCom, pseudo, contenu FROM commentaire WHERE(:nom=nom)'; //recupere les commentaires où le nom de la musique commenté = la musqique dont on veut les comm
        $this->con->executeQuery($query,array(':nom' =>array($nom,PDO::PARAM_STR)));

        return $this->con->getResult();
    }

    public function selectMaxDate($nom){
        $query = 'SELECT idCom FROM commentaire WHERE dateParution= (SELECT MIN(dateParution) FROM commentaire WHERE nom = :nom) AND nom =:nom';
        $this->con->executeQuery($query, array(':nom' =>array($nom,PDO::PARAM_STR)));
        return $this->con->getResult();
    }

    public function selectMAXID(){
        $query = 'SELECT MAX(idCom) FROM commentaire ';
        $this->con->executeQuery($query, array());
        return $this->con->getResult();
    }
    /*public function update($idCom, $pseudo,$nom,$contenu)
    {
        $query = 'UPDATE commentaire SET (:id, :pseudo,:nom,:contenu)';
        $this->con->executeQuery($query,array(':id'     =>array($idCom, PDO::PARAM_INT),
                                              ':pseudo' =>array($pseudo,PDO::PARAM_STR),
                                              ':nom'    =>array($nom,PDO::PARAM_STR),
                                              ':contenu'=>array($contenu,PDO::PARAM_STR)));
    }*/

    public function delete($idCom)
    {
        $query = 'DELETE FROM commentaire WHERE(:idCom= idCom)';
        $this->con->executeQuery($query,array(':idCom' =>array($idCom,PDO::PARAM_INT)));
    }
}