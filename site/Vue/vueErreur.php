<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="Image/img01.png"/>

    <title>Music Online</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 15/12/2016
 * Time: 22:29
 */
    foreach ($dVueErreur as $ligne){
        echo $ligne;
        ?>
        </br>
        <?php
    }
        ?>
    <a href="?action=Accueil" class="btn btn-warning">Accueil</a>
</html>