<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 04/01/2017
 * Time: 14:19
 */
class ModeleCommentaire
{
    public static function recupererCommentaire($musique){
        global $CON;
        $comGW = new commentaireGateway($CON);
        return $comGW->select($musique);
    }

    public static function insererCommentaire($pseudo, $nom, $contenu){
        global $CON;
        try {
            if($contenu==""){
                echo "c'est vide et on cree l'exeption";
                throw new Exception();
            }
            $comGW = new commentaireGateway($CON);
            $nbCom = $comGW->selectNbCom($nom);
            if ($nbCom[0][0] >= 3) {
                $idOlder = $comGW->selectMaxDate($nom);
                $comGW->delete($idOlder[0][0]);
                $id = $idOlder[0][0];
            } else {
                $currentID = $comGW->selectMAXID();
                /*if ($currentID[0][0] == 0 ){
                $id = 0;
                }
                else {*/
                $id = $currentID[0][0] + 1;
            }
            $comGW->insert($id, $pseudo, $nom, $contenu, date('Y-m-d-H-i-s'));
        }
        catch (PDOException $e1){
            throw $e1;
        }
        catch (Exception $e2){
            throw $e2;
        }
    }

    public static function supprimerCommentaire($id){
        global $CON;
        $comGW = new commentaireGateway($CON);
        $comGW->delete($id);
    }
}