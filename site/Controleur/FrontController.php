<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 13/12/2016
 * Time: 23:09
 */
class FrontController
{
    public function __construct()
    {
        //$actionVisiteur = array('seLogger', 'Accueil', 'voirDetails');
        $actionUser = array('Accueil', 'voirDetails','seDeconnecter', 'commenter', 'donnerAvis');
        $actionAdmin = array('Accueil', 'voirDetails','seDeconnecter','commenter', 'ajouterMusic', 'ValiderAjout', 'supprimerMusic', 'supprimerCommentaire', 'donnerAvis');

        $token = ModeleSession::getToken();
        //0->visiteur
        //1->user
        //2->admin
        if (isset($_REQUEST['action'])){
            $action = $_REQUEST['action'];
        }

        $dVueErreur = array();
       // try {
            switch ($token){
                case 1:
                    if(in_array($action, $actionUser)){
                        new UserController();
                    }
                    else{
                        //si l'action est pas dans la liste elle est forcement dans le visiteur? Si oui donc on fait visiteur
                        //require ("Vue/vueErreur.php");
                        new VisiteurController();
                    }
                    break;
                case 2:
                    if(in_array($action, $actionAdmin)){
                        new adminController();
                    }
                    else{
                        //si l'action est pas dans la liste elle est peut etre dans le User sinon dans le visiteur. => pas besoin du code que j'ai fais..
                        //require ("Vue/vueErreur.php");
                        new VisiteurController();
                    }
                    break;
                default:
                    new VisiteurController();
                    break;
            }
        /*}((
        catch(PDOException $e1){
            $dVueErreur[]= "erreur PDO exception";
            require ('Vue/vueErreur.php');
        }
        catch(Exception $e2){
            $dVueErreur[]=$e2->getMessage();
            require ('Vue/vueErreur.php');
        }*/
    }
}