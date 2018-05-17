<?php
include ("configuration.php");

//Connexion à la base de données
function connection() {
  return mysqli_connect($GLOBALS['DB_host'],$GLOBALS['DB_user'],$GLOBALS['DB_password'],$GLOBALS['DB_name']);
}

// Affichage du titre
function blogTitle() {
  return $GLOBALS['blogTitle'];
}

// Fonction qui permet de se loger avec le mail et le mdp qu'on rentre
function login($mail,$mdp) {
    $con=connection();
    $q = mysqli_query($con, 'SELECT * FROM utilisateurs');

    while($tab = mysqli_fetch_assoc($q))
    {
      if($mdp == $tab['mdp'] && $mail== $tab['mail']){
        mysqli_free_result($q);
        mysqli_close($con);
        return 1;
      }
    }
      mysqli_free_result($q);
      mysqli_close($con);
      return 0;
}

// Ajouter un utilisateur à la base de données
function ajoutUtilisateur($pseudo,$mail,$mdp) {
  $con = connection();
  if (strlen($pseudo) < 4) {
    return 0;
  }
  if (strlen($mdp) < 6) {
    return 0;
  }
  $stmt = mysqli_prepare($con,"INSERT INTO utilisateurs (pseudo,mail,mdp) VALUES ('".$pseudo."','".$mail."','".$mdp."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
  return 1;
}

// Ajoute un post
function ajoutPost($id_user, $lien, $contenu_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO posts (id_user,lien,contenu_post) VALUES ('".$id_user."','".$lien."','".$contenu_post."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}


// Récupère l'id de l'utilisateur
function id_user($mail) {
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE mail='".$_GET['mail']."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['id_user'];
}

// Récupère l'id de l'utilisateur
function pseudo($mail) {
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE mail='".$_GET['mail']."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['pseudo'];
}

// Affiche les posts récents (du + récent au - récent)
function affiche_post_recent(){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM posts WHERE date >= DATE_SUB(NOW(),INTERVAL 24 HOUR) ORDER BY date DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}
 ?>
