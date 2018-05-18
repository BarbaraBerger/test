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

// Vérifie que le mail est dans la table et le mdp correspond
function login($mail,$mdp) {
  $con=connection();
  $q = mysqli_query($con, 'SELECT * FROM utilisateurs');
  while($tab = mysqli_fetch_assoc($q)){
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

// Ajoute un utilisateur à la base de données
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


// Récupère l'id de l'utilisateur correspondant au mail
function id_user($mail) {
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE mail='".$_GET['mail']."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['id_user'];
}

// Récupère le pseudo de l'utilisateur correspondant au mail
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
function affiche_my_post($id){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM posts WHERE id_user = '".$id."' ORDER BY date DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

// Trouve l'id de l'utilisateur correspondant au post
function id_user_post($id){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
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
function affiche_com_post($id){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM commentaires WHERE id_post = '".$id."' ORDER BY id_comm DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}
// Supprime un commentaire
function suppression_comm($id) {
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM commentaires WHERE id_comm = '".$id."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

// Modifie un commentaire
function modifie_contenu_comm($contenu_comm,$id_comm) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE commentaires SET contenu_comm= '".$contenu_comm."' WHERE id_comm = '".$id_comm."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}
// Trouve l'id de l'utilisateur correspond au commentaire
function id_user_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id_comm = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_user'];
}
// Trouve l'id du post correspond au commentaire
function id_post_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id_comm = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_post'];
}

//Supprime tous les commentaires d'un post
function suppr_tous_comm($id_post){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM commentaires WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Ajoute un like à un post
function add_vote_post($id_user,$id_post,$type){
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO vote_post (id_user,id_post,type) VALUES ('".$id_user."','".$id_post."','".$type."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Retire les votes sur un post
function remove_vote_post($id_post){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM vote_post WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Ajoute un like à un commentaire
function add_vote_comm($id_user,$id_post,$id_comm,$type){
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO vote_commentaire (id_user,id_post,id_comm,type) VALUES ('".$id_user."','".$id_post."','".$id_comm."','".$type."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Retire les votes sur un commentaire
function remove_vote_comm($id_comm){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM vote_commentaire WHERE id_comm = '".$id_comm."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
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

//
// //Ajoute un dislike à un post
// function add_dislike($id_user,$id_post){
//   $con = connection();
//   $stmt = mysqli_prepare($con, "INSERT INTO votes (id_user,id_post,type) VALUES ('".$id_user."','".$id_post."','dislike')");
//   mysqli_stmt_execute($stmt);
//   mysqli_close($con);
// }
 ?>
