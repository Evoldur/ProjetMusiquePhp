<?php

class UserController extends VisiteurController
{
    public function __construct()
    {
        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        }
        try {
            switch ($action) {
                case 'Accueil' :
                    $this::pageAccueil();
                    break;

                case 'voirDetails':
                    $this::detailsMusic();
                    break;

                case 'seDeconnecter':
                    $this::seDeconnecter();
                    break;

                case 'commenter':
                    $this::commenter();
                    break;

                case 'donnerAvis':
                    $this::donnerAvis();
                    break;

                default:
                    $this::pageAccueil();
                    break;
            }
        }
        catch(PDOException $e1){
            $dVueErreur[]= "erreur PDO exception";
            require ('Vue/vueErreur.php');
        }
        catch(Exception $e2){
            $dVueErreur[]=$e2->getMessage();
            require ('Vue/vueErreur.php');
        }
    }

    public static function pageAccueil()
    {
        parent::pageAccueil();
    }

    public static function detailsMusic()
    {
        $musique = $_REQUEST['musique'];
        parent::detailsMusic($musique);
    }

    public static function seDeconnecter(){
        if (ModeleSession::isConnected()) {
            ModeleSession::destroy();
            VisiteurController::pageAccueil();
        }
    }

    public static function commenter(){
        $contenu = $_POST['contenu'];
        $nomMusique = $_POST['musique'];
        $pseudo = ModeleSession::getPseudo();
        if (Validation::validerContenu($contenu)){
            ModeleCommentaire::insererCommentaire($pseudo, $nomMusique, $contenu);
        }
        else {
            //validation des parametres
            throw new Exception("Veuillez saisir un commentaire avant de valider l'ajout");
        }
        parent::detailsMusic();
    }

    public static function donnerAvis(){
        $avis = $_REQUEST['Avis'];
        $nomMusique = $_REQUEST['musique'];
        $pseudo = ModeleSession::getPseudo();
        try{
            ModeleAvis::donnerAvis($pseudo,$nomMusique,$avis);
            parent::detailsMusic();
        }
        catch (Exception $e1){
            throw $e1;
        }
    }
}