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

// Affiche le post dont l'id correspond
function affiche_post($id){
  $con=connection();
  $stmt = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

// Trouve l'utilisateur correspondant à l'id
function pseudo_id($id){
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE id_user='".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['pseudo'];
}

// Affiche mes posts
function affiche_my_post($iduser){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM posts WHERE id_user = '".$iduser."' ORDER BY date DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

// Trouve l'id de l'utilisateur correspond au post

function id_user_post($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM posts WHERE id_post = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_user'];
}
	

// Supprime un post
function suppression_post($id) {
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM posts WHERE id_post = '".$id."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

// Modifie un post
function modifie_contenu_post($contenu_post,$id_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE posts SET contenu_post= '".$contenu_post."' WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

// Ajoute un commentaire
function ajoutCom($id_user, $id_post, $contenu_comm) {
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO commentaires (id_user,id_post,contenu_comm) VALUES ('".$id_user."','".$id_post."','".$contenu_comm."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

// Affiche les commentaires d'un post
function affiche_com_post($id_user,$id_post){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM commentaires WHERE id_post = '".$id_post."' ORDER BY id DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

// Supprime un commentaire
function suppression_comm($id) {
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM commentaires WHERE id = '".$id."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

// Trouve l'id de l'utilisateur correspond au commentaire

function id_user_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_user'];
}

// Trouve l'id du post correspond au commentaire

function id_post_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_post'];
}

// // Donne le nombre de likes sur un post
// function nbe_like($id_post){
//   $con=connection();
//   $query=mysqli_query($con,"SELECT COUNT(*) FROM votes WHERE id_post='".$id_post."' AND type="like"");
//   $a=mysqli_fetch_assoc($query);
//   mysqli_close($con);
//   return $a;
// }
//
// //Donne le nombre de dislike d'un post
// function nbe_dislike($id_post){
//   $con=connection();
//   $query=mysqli_query($con,"SELECT COUNT(*) FROM votes WHERE id_post='".$id_post."' AND type="dislike"");
//   $a=mysqli_fetch_assoc($query);
//   mysqli_close($con);
//   return $a;
// }
//
// //Ajoute un like à un post
// function add_like($id_user,$id_post){
//   $con = connection();
//   $stmt = mysqli_prepare($con, "INSERT INTO votes (id_user,id_post,type) VALUES ('".$id_user."','".$id_post."','like')");
//   mysqli_stmt_execute($stmt);
//   mysqli_close($con);
// }
//
// //Ajoute un dislike à un post
// function add_dislike($id_user,$id_post){
//   $con = connection();
//   $stmt = mysqli_prepare($con, "INSERT INTO votes (id_user,id_post,type) VALUES ('".$id_user."','".$id_post."','dislike')");
//   mysqli_stmt_execute($stmt);
//   mysqli_close($con);
// }
 ?>
