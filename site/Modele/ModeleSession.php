<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 23/12/2016
 * Time: 16:16
 */
class ModeleSession
{
    private static $pseudo;

    //initialise la session
    public static function init(){
        session_start();
        if (isset($_SESSION["pseudo"])){
            self::$pseudo=$_SESSION["pseudo"];
        }
        else{
            self::$pseudo= null;
        }
    }

    //renvoie un booleen permettant de savoir si un utilisateur est connecté ou non
    public static function isConnected(){
        if(self::$pseudo != null){
            return true;
        }
        else{
            return false;
        }
    }

    //affecte à la session un pseudo d'utilisateur connecté
    public static function createSession($pseudo){
        self::$pseudo=$pseudo;
        $_SESSION["pseudo"]= $pseudo;
        //echo "$pseudo";
    }

    //deconnexion
    public static function destroy(){
        self::$pseudo=null;
        session_unset();
        session_destroy();
        $_SESSION = array();
    }


    public static function getPseudo()
    {
        return self::$pseudo;
    }

    //renvoie le token(le role) de la personne connecté ou 0 si personne n'est connecté
    public static function getToken(){
        if(self::isConnected()){
           // return VisiteurModele::getToken(self::$pseudo);
            global $CON;
            $usergateway = new utilisateurGateway($CON);
            return $usergateway->getToken(self::$pseudo);
        }
        else{
            return 0;
        }
    }
}