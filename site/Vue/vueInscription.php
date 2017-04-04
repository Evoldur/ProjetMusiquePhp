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
                        <li class=""><a href="?action=Accueil">Home</a></li>
                        <li class="active"><a href="?action=Accueil">Inscription</a></li>
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
                <form action="index.php" onsubmit="return checkForm(this)" method="post">
                    <p>
                        Nom : <input type="text" name="nomInscription" onblur="checkName(this)"/><br />
                    <p id = "nomError"></p>
                    Prenom : <input type="text" name="prenomInscription" onblur="checkFirstname(this)"/><br />
                    <p id = "prenomError"></p>
                    Date de naissance : <input type="text" name="birthday" onblur="checkAge(this)"/><br />
                    <p id = "ddnError"></p>
                    E-mail : <input type="text" name="emailInscription" size="30" onblur="checkMail(this)"/><br />
                    <p id = "emailError"></p>
                    Mot de passe : <input type="password" name="passwordInscription" size="30" onblur="checkPassword(this)"/><br />
                    <p id = "pswError"></p>
                    Confirmez mot de passe ! <input type="password" name="psw" size="30" onblur="checkPasswordConfirm(this)"/><br />
                    <p id = "pswconfirmError"></p>
                    <input type="hidden" value="validerInscription" name="action"/>
                    <input type="submit" value="Valider"/>
                    </p>

                </form>
                <script src="ScriptJs/validationInscription.js"></script>

            </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
    </div><!--/row-->

    <hr>
</div>
</body>
<footer class="footer">
    <p>Réalisé par Guillaume Force et  Virgile Coste. IPI4.</p>
</footer>
</html>
