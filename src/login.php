<?php
    session_start();
include("configuration.php");
include("fonctions.php");

if( isset($_GET['password']) && isset($_GET['mail'])){

  if(login($_GET['mail'],$_GET['password'])){
    $_SESSION['mdp'] = $_GET['password'];
    $_SESSION['mail'] = $_GET['mail'];
    date_default_timezone_set("Europe/Paris");
    $_SESSION['dateCo'] =date("Y-m-d H:i:s");
    $_SESSION['id_user'] = id_user($_SESSION['mail']);
    $_SESSION['pseudo'] = pseudo($_SESSION['mail']);
    header('Location: accueil.php');

  } else {
    if (isset($_GET['password']) && isset($_GET['mail'])){
      $msg = "Adresse mail et/ou mot de passe incorrect(s)";
  }
}
}


?>


<html>
  <head>
    <meta charset ="utf-8"/>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> <?php echo blogTitle(); ?> </title>
  </head>

  <body>
    <span class="border border-white "></span>
    <div class="alert alert-success">
    <h1> <p class="text-center"> Connexion </p> </h1>
          <section class='row'>
            <h1 class="col-md-2"> </h1>
              <h1 class="col-md-8">
                <div class="form-group">
                  <form action = "login.php" method = "get">
                     <hr size=4 width=66% align=center >
                     <div> <font size = "3"> <?php echo "$msg"; ?> </font> </div>
                    <label> <h4> Mail  :</h4> </label><input type = "email" class="form-control" name = "mail" placeholder="Veuillez entrer votre adresse mail"/>
                    <label> <h4> Mot de passe :</h4> </label><input type = "password" class="form-control" name = "password" placeholder="Veuillez entrer votre mot de passe"/>
                </div>
              </h1>
          </section>
        <center> <input type = "submit" class="btn btn-primary" value = " Se connecter "/> </center>
        <h4> <p align="right"> Tu n'as pas encore de compte ? <a href = "inscription.php"> Incris-toi ! </a> </h4>
      </form>
    </div>
  </body>
</html>
