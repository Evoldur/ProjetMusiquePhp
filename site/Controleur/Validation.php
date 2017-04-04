 <?php

class Validation
{
    static $tabSize = array('email'=>50, 'couvertureAlbum'=>250);

    function __construct()
    {
    }


    public static function validerEmail($email){
        if( (isset($email)) && (filter_var($email,FILTER_VALIDATE_EMAIL)) && (sizeof($email) <= self::$tabSize['email']) ){
            return true;
        }
        else{
            return false;
        }
    }

    public static function validerNomMusic($nomMusic){
        $expReg = "`^[A-Za-z0-9-_ éè']{1,50}$`";
        if(preg_match($expReg,$nomMusic)){
            return true;
        }
        else return false;
    }

    public static function validerContenu($contenu){
        $expReg = "`^[A-Za-z0-9-_ éè']{1,300}$`";
        if(preg_match($expReg,$contenu)){
            return true;
        }
        else return false;
    }

    public static function validerCouverture($couverture){
        if(isset($couverture) && ( sizeof($couverture)<= self::$tabSize['couvertureAlbum'])){
            return true;
        }
        else return false;
    }

    public static function validerPassword($password){
        $expReg = "`^[A-Za-z0-9-]{1,15}$`";
        if(preg_match($expReg,$password)){
            return true;
        }
        else return false;
    }

    /**
     * @param $pseudo
     * @return bool
     * sera utiliser si nous réalisons l'inscription d'utilisateur
     */
    public static function validerPseudo($pseudo){
        $expReg = "`^[A-Za-z0-9-]{1,30}$`";
        if(preg_match($expReg,$pseudo)){
            return true;
        }
        else return false;

    }

    public static function validerDuree($duree){
        $expReg = "`^[(0-9)]{1,2}+:+[(0-9)]{2}$`";
        if(preg_match($expReg,$duree)){
            return true;
        }
        else return false;
    }
    /*
    static function validation($tab){
        foreach ($tab as $ligne){
            switch ($ligne['type']) {
                case "string":
                    $res[] = filter_var($ligne['value'], FILTER_VALIDATE_STRING);
                    $res[] = filter_var($ligne['value'], FILTER_SANITIZE_STRING);
                    break;
                case "email":
                    $res[] = filter_var($ligne['value'], FILTER_VALIDATE_EMAIL);
                    $res[] = filter_var($ligne['value'], FILTER_SANITIZE_EMAIL);
                    break;
                case "temps":
                    $expression = "[0-9][0-9][0-9]:[0-9][0-9]";
                    if(preg_match($expression, $res)){
                        $res = $res;
                    } else {
                        $res = false;
                    }
                case "link":
                    $res[] = filter_var($ligne['value'], FILTER_VALIDATE_URL);
                    $res[] = filter_var($ligne['value'], FILTER_SANITIZE_URL);
                default:
                    $res[] = preg_match($ligne['type'], $ligne['value']);
            }
        }
        return $res;
    }*/

}