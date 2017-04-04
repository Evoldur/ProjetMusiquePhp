<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 07/12/2016
 * Time: 18:56
 */
class utilisateurGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function insert($email,$pseudo,$password,$token)
    {
        $query = 'INSERT INTO utilisateur VALUES (:email,:pseudo,:password,:token)';
        $this->con->executeQuery($query,array(':email'     =>array($email,PDO::PARAM_STR),
                                               ':pseudo'    =>array($pseudo,PDO::PARAM_STR),
                                               ':password'  =>array($password,PDO::PARAM_STR),
                                               ':token'     =>array($token,PDO::PARAM_INT)));
    }

    public function select($email,$password)
    {
        $query = 'SELECT pseudo FROM utilisateur WHERE(:email=email AND :password = password)';
        //$query = 'SELECT * from utilisateur';
        $this->con->executeQuery($query,array(':email'     =>array($email,PDO::PARAM_STR),
                                              ':password'  =>array($password,PDO::PARAM_STR)));
        $res = $this->con->getResult();
        if($res != NULL){
            return $res;
        }
    }

    public function getToken($pseudo)
    {
        $query = 'SELECT token FROM utilisateur WHERE(:pseudo=pseudo)';

        $this->con->executeQuery($query,array(':pseudo'  =>array($pseudo,PDO::PARAM_STR)));
        $res = $this->con->getResult();
        if($res != null){
            return $res[0][0];
        }
        else{
            return null;
        }
    }

    public function update($email,$pseudo,$password,$token)
    {
        $query = 'UPDATE utilisateur SET (:email,:pseudo,:password,:token)';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':password' => array($password, PDO::PARAM_STR),
            ':token' => array($token, PDO::PARAM_INT)));
    }
}