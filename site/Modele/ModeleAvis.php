<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 08/01/2017
 * Time: 14:52
 */
class ModeleAvis
{
    public static function donnerAvis($pseudo, $nom, $avis){
        global $CON;
        $avisGW = new avisGateway($CON);


        $tabAvis = MusicModele::selectAvis($nom);

        if($avisGW->select($pseudo,$nom) == null){
            $avisGW->insert($pseudo,$nom,$avis);
        }
        else{
            $typeAvis = $avisGW->select($pseudo,$nom);
            $avisGW->update($pseudo,$nom,$avis);
            switch ($typeAvis[0][0]){
                case 'Aimer':
                    $tabAvis[0][0]--;
                    $test = $tabAvis[0][0];
                    echo "$test";
                    //$musicGW->update($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                    MusicModele::upadate($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                    break;
                case 'PasAimer':
                    $tabAvis[0][1]--;
                    //$musicGW->update($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                    MusicModele::upadate($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                    break;
                case 'Neutre':
                    $tabAvis[0][2]--;
                    //$musicGW->update($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                    MusicModele::upadate($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                    break;
                default:
                    throw new Exception("Erreur avis");
            }
        }
        switch ($avis){

            case 'Aimer':
                $tabAvis[0][0] = $tabAvis[0][0]+1;
                //$musicGW->update($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                MusicModele::upadate($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                break;
            case 'PasAimer':
                $tabAvis[0][1]++;
                //$musicGW->update($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                MusicModele::upadate($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                break;
            case 'Neutre':
                $tabAvis[0][2]++;
                //$musicGW->update($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                MusicModele::upadate($nom,$tabAvis[0][0],$tabAvis[0][1],$tabAvis[0][2]);
                break;
            default:
                throw new Exception("Erreur avis");
        }
    }
}