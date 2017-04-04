<?php

class adminController extends UserController
{
    public function __construct()
    {
        if (isset($_REQUEST['action'])){
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

                case 'ajouterMusic':
                    $this::ajouterMusic();
                    break;

                case 'ValiderAjout':
                    adminController::validerAjout();
                    break;

                case 'supprimerMusic':
                    $this::supprimerMusic();
                    break;
                case 'supprimerCommentaire':
                    $this::supprimerCommentaire();
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

    /**
     * appelle la methode pageAccueil
     * de la classe mère, UserController
     */
    public static function pageAccueil()
    {
        parent::pageAccueil();
    }

    /**
     * appelle la methode detailMusic de
     * la classe mère , UserController
     */
    public static function detailsMusic()
    {
        parent::detailsMusic();
    }

    /**
     * appelle la methode seDeconnecter de
     * la classe mère , UserController
     */
    public static function seDeconnecter()
    {
        parent::seDeconnecter();
    }

    /**
     * appelle la methode commenter de
     * la classe mère , UserController
     */
    public static function commenter()
    {
        parent::commenter();
    }

    /**
     * permet de faire afficher la vue d'ajout
     * d'une musique, seulement à un utilisateur
     * connecté et dont le role est administrateur
     * (token = 2)
     */
    public static function ajouterMusic(){
        if(ModeleSession::getToken() == 2) {
            $connected = ModeleSession::isConnected();
            $pseudoAccueil = ModeleSession::getPseudo();
            $token = ModeleSession::getToken();
            require("Vue/vueAjoutMusic.php");
        }
    }

    /**
     * Recupere le nom d'une musique à ajouter
     * ainsi que le lien de la couverture de l'album
     * et la durée d'écoute puis appelle la methode
     * ajouterMusic de MusicModele, prenant en parametre
     * les trois données récupérés.
     * A la fin de l'ajout, redirige vers la vue d'accueil.
     */
    public static function validerAjout(){
        $nomAlbum = $_POST['nomAlbum'];
        $couvertureAlbum = $_POST['couvertureAlbum'];
        $dureeEcoute = $_POST['dureeEcoute'];
        if( (Validation::validerNomMusic($nomAlbum)) && (Validation::validerCouverture($couvertureAlbum)) && (Validation::validerDuree($dureeEcoute)) ){
            MusicModele::ajouterMusic($nomAlbum, $couvertureAlbum, $dureeEcoute);
            parent::pageAccueil();
        }
        else{
            throw new Exception("Inserer des informations valides dans les champs requis");
        }
    }

    /**
     * Permet à un administrateur connecté de supprimer
     * une musique en appelant la méthode supprimerMusic
     * de MusicModele, prenant en parametre le nom de
     * la musique que l'on récupere dans cette methode
     */
    public static function supprimerMusic(){
        if(ModeleSession::getToken() == 2) {
            $nom = $_REQUEST['musique']; //peut etre faire un ID? Mieux.
            //validation du titre passé et/ou de l'ID
            MusicModele::supprimerMusic($nom);
            parent::pageAccueil();

        }

    }

    /**
     *Permet à un administrateur connecté de supprimer
     * un commentaire par rapport à une musique en
     * appelant la méthode supprimerCommentaire de
     * ModeleCommentaire, prenant en parametre l'id
     * du commentaire que l'on récupere dans cette methode
     */
    public static function supprimerCommentaire(){
        if(ModeleSession::getToken() == 2) {
            $id = $_REQUEST['id'];
            $musique = $_REQUEST['musique'];
            //validation du titre passé et/ou de l'ID
            ModeleCommentaire::supprimerCommentaire($id);
            VisiteurController::detailsMusic($musique);
        }

    }

    /**
     * appelle la methode donnerAvis de
     * la classe mère , UserController
     */
    public static function donnerAvis()
    {
        parent::donnerAvis();
    }
}