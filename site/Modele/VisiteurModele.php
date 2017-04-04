<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 14/12/2016
 * Time: 12:41
 */
class VisiteurModele
{
    //permet à un utilisateur de se connecter à partir d'un mot de passe et d'une adresse email et renvoie un pseudo
    public static function seLogger($login, $password)
    {

        global $CON;
        try {
            $usergateway = new utilisateurGateway($CON);
            $result = $usergateway->select($login, $password);
            if ($result == NULL) {
                throw $e2 = new Exception("Login/Mot de passe errone");
            } else {
                ModeleSession::createSession($result[0][0]);
            }
        } catch (Exception $e1) {
            throw $e1;
        }
    }

    public static function inscription($email, $pseudo, $password)
    {
        global $CON;
        try {
            $usergateway = new utilisateurGateway($CON);
            $usergateway->insert($email, $pseudo, $password, 1);
        } catch (Exception $e1) {
            throw $e1;
        }

    }
    //permet à partir du pseudo de recuperer le role de l'utilisateur
    /*
    public static function getToken($pseudo){
        global $CON;
        $usergateway = new utilisateurGateway($CON);
        return $usergateway->getToken($pseudo);
    }*/
}