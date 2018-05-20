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
  }
  else {
    if (isset($_GET['password']) && isset($_GET['mail'])){
      $msg = "Adresse mail et/ou mot de passe incorrect(s)";
    }
  }
}
?>

<html>
  <head>
    <meta charset = "utf-8"/>
    <title> <?php echo blogTitle(); ?> </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class='container w-75'>
      <br>
      <header>
        <center> <h1> Connexion </h1> </center>
        <hr size=4 width=75% align=center >
        <br>
      </header>
      <section class="jumbotron" id='2'>
        <section class='row'>
          <div class="col-md-2"> </div>
          <div class="col-md-8">
            <div class="form-group">
              <form action = "login.php" method = "get">
                <h2 id='msg'> <?php echo "$msg"; ?> </h2>
                <input type = "email" class="form-control" name = "mail" placeholder="Veuillez entrer votre adresse mail"/><br>
                <input type = "password" class="form-control" name = "password" placeholder="Veuillez entrer votre mot de passe"/><br>
                <center> <input type = "submit" class="btn btn-primary" value = " Se connecter "/> </center>
              </form>
            </div>
          </div>
        </section>
      </section>
      <h4> <p align="right"> Tu n'as pas encore de compte ? <a href = "inscription.php"> Incris-toi ! </a> </h4>
    </div>
  </body>
</html>
