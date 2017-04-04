<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 14/12/2016
 * Time: 14:26
 */
    require_once(__DIR__.'/config/config.php');

    //chargement autoloader pour autochargement des classes
    require_once(__DIR__.'/config/Autoload.php');
    Autoload::charger();

    global $base, $loginBase, $mdpBase;
    $CON = new Connection($base,$loginBase,$mdpBase);

    ModeleSession::init();

    $cont = new FrontController();
?>