<?php

class VisiteurController{

    //LOGIN
    //MOT DE PASSE
    //VALIDATION DES LOGIN/PASSWORD
    public function __construct()
    {
        if (isset($_REQUEST['action'])){
            $action = $_REQUEST['action'];
        }
        else{
            $action = null;
        }
        try {
            switch ($action) {

                case null:
                    ModeleSession::destroy();
                    $this::pageAccueil();
                    break;

                case 'seLogger':
                    $this::seLogger();
                    break;

                case 'Accueil' :
                    $this::pageAccueil();
                    break;
                case 'voirDetails':
                    $this::detailsMusic();
                    break;
                case 'Inscription':
                    $this::pageInscription();
                    break;
                case 'validerInscription':
                    $this::validerInscription();
                default:
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



    //permet de s'identifier
    public static function seLogger(){
        if (isset($_POST['login']) & isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
        }
        if(Validation::validerEmail($login) && Validation::validerPassword($password)){
            if (ModeleSession::getToken() == 0) {
                VisiteurModele::seLogger($login,$password);
                VisiteurController::pageAccueil();
            }
        }
        else{
            throw new Exception("Veuillez inserer un email/ mot de passe valide");
        }


    }

    //Affiche la page d'accueil
    public static function pageAccueil(){
        $connected = ModeleSession::isConnected();
        $pseudoAccueil = ModeleSession::getPseudo();
        $token = ModeleSession::getToken();//VisiteurModele::getToken();
        $result = MusicModele::listerMusic();
        require ('Vue/vueAccueil.php');
    }

    public static function detailsMusic(){
        $musique = $_REQUEST['musique'];
        $connected = ModeleSession::isConnected();
        $pseudoAccueil = ModeleSession::getPseudo();
        $token = ModeleSession::getToken();
        $res = MusicModele::detailsMusic($musique);
        $tabcomment = ModeleCommentaire::recupererCommentaire($musique);
        require ("Vue/vueDetail.php");
    }

    public static function pageInscription(){
        $connected = ModeleSession::isConnected();
        $pseudoAccueil = ModeleSession::getPseudo();
        $token = ModeleSession::getToken();//VisiteurModele::getToken();
        $result = MusicModele::listerMusic();
        require ('Vue/vueInscription.php');
    }

    public static function validerInscription(){
        $pseudo = $_POST['nomInscription'];
        $email = $_POST['emailInscription'];
        $psw = $_POST['passwordInscription'];
        VisiteurModele::inscription($email, $pseudo, $psw);
        self::pageAccueil();
    }
}

