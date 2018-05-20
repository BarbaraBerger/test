<?php session_start();

include ("configuration.php");
include ("fonctions.php");

$pseudo=$_GET['pseudo'];
$mail=$_GET['mail'];
$mdp=$_GET['mdp'];

if(verificationUtilisateur($pseudo,$mail)){
 if(ajoutUtilisateur($pseudo,$mail,$mdp)){
  if(isset($mail) && isset($mdp)){
    if(login($mail,$mdp)){
      $_SESSION['mdp'] = $mdp;
      $_SESSION['mail'] = $mail;
      date_default_timezone_set("Europe/Paris");
      $_SESSION['dateCo'] =date("Y-m-d H:i:s");
      $_SESSION['id_user'] = id_user($_SESSION['mail']);
      $_SESSION['pseudo'] = $pseudo;
      header('Location: accueil.php');
      }
    }
  }
} else {
    if (isset($pseudo) && isset($mail) && isset ($mdp)){
      $msg = "Veuillez rentrer un identifiant valide (au moins 4 caractères) et un mot de passe valide (au moins 6 caractères) ou pseudo ou mail déjà utilisé";
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
        <center> <h1> Inscription </h1> </center>
        <hr size=4 width=75% align=center >
      </header>
      <br>
      <section class="jumbotron" id='3'>
        <section class='row'>
          <div class="col-md-2"> </div>
          <div class="col-md-8">
            <div class="form-group">
              <form action = "inscription.php" method = "get">
                <h2 id='msg'> <?php echo "$msg"; ?> </h2>
                <input type="text" class="form-control" name='pseudo' placeholder="Veuillez choisir un pseudo d'au moins 4 caractères" required/> <br>
                <input type="email" class="form-control" name='mail' placeholder="Veuillez entrer votre adresse mail" required/><br>
                <input type="text" class="form-control" name='mdp' placeholder="Veuillez entrer un mot de passe d'au moins 6 caractères" required/><br>
                <center> <input type = "submit" class="btn btn-primary" value = " S'inscrire "/> </center>
              </form>
            </div>
          </div>
        </section>
      </section>
      <h4> <p align="right"> Tu as déjà un compte ? <a href = "login.php"> Connecte-toi ! </a> </h4>
    </div>
  </body>
</html>
