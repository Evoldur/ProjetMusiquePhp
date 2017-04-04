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
<header>
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="?action=Accueil">Home</a></li>
                        <?php
                        if(($connected == true) && ($token ==2)){
                            ?>
                            <li class="active"><a href="?action=ajouterMusic">Ajouter musique</a> </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
                    if ($connected){
                        ?>
                        <span class="label label-info"><?php echo $pseudoAccueil ?></span>
                        <a href="?action=seDeconnecter" class="btn btn-warning">Déconnexion</a>
                        <?php
                    }
                    ?>
                </div>
            </div><!-- /.container -->
    </nav><!-- /.navbar -->
</header>

<body>

<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
            <div class="jumbotron">
                <h1>Ajout musique!!!</h1>
            </div>
        </div>
        <div class="col-xs-6 col-sm-5">
            <div class="row">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <input required type="text" name="nomAlbum" placeholder="Nom Album" class="form-control">
                    </div>

                    <div class="form-group">
                        <input required type="text" name="couvertureAlbum" placeholder="Couverture de l'album" class="form-control">
                    </div>

                    <div class="form-group">
                        <input required type="time" name="dureeEcoute" placeholder="Duree d'ecoute" class="form-control">
                    </div>

                    <input type="hidden" value="ValiderAjout" name="action">
                    <button <input type="submit" class="btn btn-success"> Valider</button>
                </form>
            </div><!--/row-->
        </div><!--/.col-xs-6.col-sm-9-->
</div>
</body>
<hr>
<footer>
    <p>Réalisé par Guillaume Force et Eric Lemaitre, Groupe 3</p>
</footer>
</html>
