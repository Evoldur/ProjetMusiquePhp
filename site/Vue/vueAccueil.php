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
                        <li class="active"><a href="?action=Accueil">Home</a></li>
                        <?php
                        if(($connected == false) && ($token == 0)){
                            ?>
                            <li class=""><a href="?action=Inscription">Inscription</a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if(($connected == true) && ($token ==2)){
                            ?>
                            <li><a href="?action=ajouterMusic">Ajouter musique</a> </li>
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
                        <a href="?action=seDeconnecter" class="btn btn-warning">Deconnexion</a>
                        <?php
                    }
                    else {
                        ?>
                        <form class="navbar-form navbar-right" action="index.php" method="post">
                            <div class="form-group">
                                <input type="email" name="login" placeholder="Email" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control"/>
                                <input type="hidden" value="seLogger" name="action"/>
                            </div>
                            <button <input type="submit" class="btn btn-success"/> Connexion</button>

                        </form>

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
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                </p>
                <div class="jumbotron">
                    <h1>Music Online</h1>
                </div>
                <div class="row">
                <?php
                if($result!=null){
                    foreach ($result as $ligne) {
                        ?>
                        <img height="30" width="30" src="<?php echo("$ligne[1]");?>"/>
                        <?php echo "$ligne[0]"?>
                        <img src="Image/Like.png"/><?php
                        echo "$ligne[3]" ?>
                        <img src="Image/Dislike.png"/><?php
                        echo "$ligne[4]" ?>
                        <img src="Image/Neutre.png"/>
                        <?php
                        echo "$ligne[5] Mise en ligne le $ligne[2]";?>
                        <a href="?action=voirDetails&musique=<?php echo "$ligne[0]"?>"> Details...    </a>
                        <?php
                        if(($connected == true) && ($token ==2)){
                        ?>
                        <a href="?action=supprimerMusic&musique=<?php echo "$ligne[0]"?>">Supprimer</a>
                        <?php
                        }
                        ?>
                        </br>
                        </br>
                        <?php
                    }
                }
                ?>

                </div><!--/row-->
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

        <hr>
    </div>
</body>
<footer class="footer">
    <p>Réalisé par Guillaume Force et Virgile Coste. IPI4.</p>
</footer>
</html>
