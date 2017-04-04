<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 22/12/2016
 * Time: 23:22
 */
class MusicModele{

    //
    public static function ajouterMusic($nomAlbum, $couvertureAlbum, $dureeEcoute){
        global $CON;
        $musicGW = new MusicGateway($CON);
        //nb music avant l'ajout
        $av = $musicGW->count();
        try{
            $musicGW->insert($nomAlbum,$couvertureAlbum,date('Y-m-d'), 0, 0, 0, $dureeEcoute);
        }

        catch (Exception $e1){
            $ap = $musicGW->count();
            if($av[0][0] == $ap[0][0]){
                throw new Exception("Ajout impossible. Titre déjà repertorié");
            }
            else{
                throw new PDOException($e1);
            }
        }
    }

    public static function listerMusic(){
        global $CON;
        $musicGW= new MusicGateway($CON);
        return $musicGW->select();
    }

    public static function detailsMusic($musique){
        global $CON;
        $musicGW= new MusicGateway($CON);
        return $musicGW->selectDetail($musique);
    }

    public static function supprimerMusic($musique){
        global $CON;
        $musicGW= new MusicGateway($CON);
        $musicGW->delete($musique);
    }

    public static function selectAvis($nom){
        global $CON;
        $musicGW = new MusicGateway($CON);
        return $musicGW->selectAvis($nom);
    }

    public static function upadate($nom,$avisFav,$avisDefav,$avisNeutre){
        global $CON;
        $musicGW = new MusicGateway($CON);
        $musicGW->update($nom, $avisFav, $avisDefav, $avisNeutre);
    }
}