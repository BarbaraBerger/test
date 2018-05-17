<?php session_start(); /* First start a session */ ?>

<?php

include ("configuration.php");
include ("fonctions.php");

$pseudo=$_GET['pseudo'];
$mail=$_GET['mail'];
$mdp=$_GET['mdp'];

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
} else {
  if (isset($pseudo) && isset($mail) && isset ($mdp)){
    $msg = "Veuillez rentrer un identifiant valide (au moins 4 caractères) et un mot de passe valide (au moins 6 caractères)";
  }
}

?>
<html>
  <head>
    <meta charset ="utf-8"/>
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> <?php echo blogTitle(); ?> </title>
  </head>
  <body>
    <span class="border border-white "></span>
    <div class="alert alert-success">
      <h1> <p class="text-center"> INSCRIPTION </p> </h1>
      <form>
          <section class='row'>
             <h1 class="col-md-2"> </h1>
             <h1 class="col-md-8">
               <div class="form-group">
                 <form action="inscription.php" method="get">
                    <hr size=4 width=66% align=center >
                    <div> <font size = "3"> <?php echo "$msg"; ?> </font> </div>
                    <label> <h4> Pseudo : </h4></label><input type="text" class="form-control" id="pseudo" name='pseudo' placeholder="Veuillez choisir un pseudo d'au moins 4 caractères" required/>

                 		<label> <h4> Adresse Mail : </h4> </label><input type="email" class="form-control" id="mail" name='mail' placeholder="Veuillez entrer votre adresse mail" required/>

                 		<label> <h4> Mot de passe : </h4> </label><input type="text" class="form-control" id="mdp" name='mdp' placeholder="Veuillez entrer un mot de passe d'au moins 6 caractères" required/>
            </h1>
          </section>
          <center><input type="submit" class="btn btn-primary" value="Inscription" /></center>
          <h4> <p align="right"> Tu as déjà un compte ? <a href = "login.php"> Connecte-toi ! </a> </h4>
      </form>
    </div>
  </body>
</html>
