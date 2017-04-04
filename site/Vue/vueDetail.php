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
                        <li class="active"><a>Details </a></li>
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
                    if (ModeleSession::isConnected()){
                        ?>
                        <span class="label label-info"><?php echo $pseudoAccueil ?></span>
                        <a href="?action=seDeconnecter" class="btn btn-warning">Déconnexion</a>
                        <?php
                    }
                    else {
                        ?>

                        <form class="navbar-form navbar-right" action="index.php" method="post">
                            <div class="form-group">
                                <input type="email" name="login" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <input type="hidden" value="seLogger" name="action">
                            </div>
                            <button <input type="submit" class="btn btn-success"> Connexion</button>
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
            <div class="jumbotron">
                <h1>Fiche detaillee</h1>
            </div>
        </div>

        <div  class="col-xs-12 col-sm-9">
            <?php
            foreach ($res as $ligne) {
                ?>
                <h4><?php echo "Titre : $ligne[0]"?></h4>
                <img height="200" width="300" src="<?php echo("$ligne[1]");?>"/>
                </br><?php
                echo "Durée d'écoute : $ligne[6]";

                if($connected == true) {
                    ?>
                    </br>
                    <a href="?action=donnerAvis&Avis=Aimer&musique=<?php echo("$ligne[0]");?>">
                        <img src="Image/Like.png"/>
                    </a><?php
                    echo "$ligne[3]" ?>
                    <a href="?action=donnerAvis&Avis=PasAimer&musique=<?php echo("$ligne[0]");?>">
                        <img src="Image/Dislike.png"/>
                    </a><?php
                    echo "$ligne[4]" ?>
                    <a href="?action=donnerAvis&Avis=Neutre&musique=<?php echo("$ligne[0]");?>">
                        <img src="Image/Neutre.png"/>
                    </a><?php
                }
                else{
                    ?>
                    </br>
                    <img src="Image/Like.png"/><?php
                    echo "$ligne[3]" ?>
                    <img src="Image/Dislike.png"/><?php
                    echo "$ligne[4]" ?>
                    <img src="Image/Neutre.png"/><?php
                }
                echo "$ligne[5]";?>
                </br><?php
                echo "Mise en ligne le $ligne[2]";
            }
            ?>
            <br>
            <h3>Commentaires : </h3>
            <br>
            <?php
            if($tabcomment == null){
                echo ("Aucun commentaire n'a ete poste pour ce titre.");
            }
            else{
                foreach ($tabcomment as $com){
                    echo ("$com[1] : $com[2]");
                    if(($connected == true) && ($token ==2)){
                        ?>
                        <a href="?action=supprimerCommentaire&id=<?php echo "$com[0]"?>&musique=<?php echo "$ligne[0]"?>">Supprimer</a>
                        <?php
                    }
                    ?>
                    <br>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        if($connected == true){
        ?>
        <div class="col-sm-4">
            </br>
            <form class="navbar-form navbar-right" action="index.php" method="post">
                <div class="form-group">
                    <input required type="text" name="contenu" class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" value="commenter" name="action">
                    <input type="hidden" value="<?php echo $ligne[0]?>" name="musique">
                </div>
                <button
                <input type="submit" class="btn btn-success"> Commenter</button>
            </form>
        </div><!--/.col-xs-6.col-sm-9-->
        <?php
        }
        else{
        ?>
        <div class="col-sm-5">
            </br>
            </br>
            <h4>Connectez vous pour pouvoir poster un commentaire</h4>
            </br>
            </br>
        </div>
        <?php
        }
        ?>
    </div>
</body>
<hr>
<footer>
    <p>Réalisé par Guillaume Force et Eric Lemaitre, Groupe 3</p>
</footer>
</html>
