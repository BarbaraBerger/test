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

// Vérification de la présence du mail dans la table utilisateurs et la correspondance du mdp
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

// Ajout d'un utilisateur à la table utilisateurs
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

// Ajout d'un post dans la table posts
function ajoutPost($id_user, $lien, $contenu_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO posts (id_user,lien,contenu_post) VALUES ('".$id_user."','".$lien."','".$contenu_post."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

// Récupération de l'id de l'utilisateur correspondant au mail dans la table utilisateurs
function id_user($mail) {
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE mail='".$_GET['mail']."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['id_user'];
}

//Récupération du pseudo de l'utilisateur correspondant au mail dans la table utilisateurs
function pseudo($mail) {
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE mail='".$_GET['mail']."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['pseudo'];
}

// Affichage des posts du + récent au - récent
function affiche_post_recent(){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM posts WHERE date >= DATE_SUB(NOW(),INTERVAL 24 HOUR) ORDER BY date DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

//Affichage du post dont l'id correspond dans la table posts
function affiche_post($id){
  $con=connection();
  $stmt = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

//Récupération du pseudo correspondant à l'id dans la table utilisateurs
function pseudo_id($id){
  $con=connection();
  $query=mysqli_query($con,"SELECT * FROM utilisateurs WHERE id_user='".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['pseudo'];
}

//Affichage des posts d'un utilisateur selon son id
function affiche_my_post($id){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM posts WHERE id_user = '".$id."' ORDER BY date DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

//Récupération de l'id de l'utilisateur correspondant au post
function id_user_post($id){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['id_user'];
}

//Suppression d'un post
function suppression_post($id) {
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM posts WHERE id_post = '".$id."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Modification de la description d'un post
function modifie_contenu_post($contenu_post,$id_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE posts SET contenu_post= '".$contenu_post."' WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Modification du lien d'un post
function modifie_contenu_lien($lien,$id_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE posts SET lien= '".$lien."' WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Ajout d'un commentaire
function ajoutCom($id_user, $id_post, $contenu_comm) {
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO commentaires (id_user,id_post,contenu_comm) VALUES ('".$id_user."','".$id_post."','".$contenu_comm."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Affichage des commentaires d'un post
function affiche_com_post($id){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT * FROM commentaires WHERE id_post = '".$id."' ORDER BY id_comm DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

//Suppression d'un commentaire
function suppression_comm($id) {
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM commentaires WHERE id_comm = '".$id."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Modification d'un commentaire
function modifie_contenu_comm($contenu_comm,$id_comm) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE commentaires SET contenu_comm= '".$contenu_comm."' WHERE id_comm = '".$id_comm."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Récupération de l'id de l'utilisateur correspondant au commentaire
function id_user_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id_comm = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_user'];
}

//Récupération de l'id du post correspondant au commentaire
function id_post_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id_comm = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['id_post'];
}

//Récupération du contenu du commentaire correspondant à l'id
function id_com($id){
  $con = connection();
  $query = mysqli_query($con, "SELECT * FROM commentaires WHERE id_comm = '".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
return $a['contenu_comm'];
}

//Suppression de tous les commentaires d'un post
function suppr_tous_comm($id_post){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM commentaires WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Ajout d'un vote à un post
function add_vote_post($id_user,$id_post,$type){
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO vote_post (id_user,id_post,type) VALUES ('".$id_user."','".$id_post."','".$type."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Suppression de tous les votes d'un post
function remove_vote_post($id_post){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM vote_post WHERE id_post = '".$id_post."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Ajout d'un vote à un commentaire
function add_vote_comm($id_user,$id_post,$id_comm,$type){
  $con = connection();
  $stmt = mysqli_prepare($con, "INSERT INTO vote_commentaire (id_user,id_post,id_comm,type) VALUES ('".$id_user."','".$id_post."','".$id_comm."','".$type."')");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Suppression de tous les votes d'un commentaire
function remove_vote_comm($id_comm){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM vote_commentaire WHERE id_comm = '".$id_comm."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Annulation du vote d'un utilisateur sur un post
function suppr_vote_post($id_post,$id_user){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM vote_post WHERE id_post = '".$id_post."' AND id_user = '".$id_user."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Check si l'utilisateur a déjà fait le même vote sur un post
function verif_meme_type_vote_post($id_user,$id_post,$type) {
  $con=connection();
  $q = mysqli_query($con, 'SELECT * FROM vote_post');
  while($tab = mysqli_fetch_assoc($q)){
    if($id_user == $tab['id_user'] && $id_post== $tab['id_post'] && $type == $tab['type'] ){
      mysqli_free_result($q);
      mysqli_close($con);
      return 1;
    }
  }
  mysqli_free_result($q);
  mysqli_close($con);
  return 0;
}

//Check si l'utilisateur a déjà voté mais un vote différent sur un post
function verif_different_type_vote_post($id_user,$id_post,$type) {
  $con=connection();
  $q = mysqli_query($con, 'SELECT * FROM vote_post');
  while($tab = mysqli_fetch_assoc($q)){
    if($id_user == $tab['id_user'] && $id_post== $tab['id_post'] && $type != $tab['type']){
      mysqli_free_result($q);
    	mysqli_close($con);
    	return 1;
    }
  }
  mysqli_free_result($q);
  mysqli_close($con);
  return 0;
}

//Modification d'un dislike en un like sur un post
function modifie_dislike_en_like_post($id_user,$id_post){
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE vote_post SET type= 'like' WHERE id_user = '".$id_user."' AND id_post = '".$id_post."'" );
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Modification d'un like en un dislike sur un post
function modifie_like_en_dislike_post($id_user,$id_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE vote_post SET type= 'dislike' WHERE id_user = '".$id_user."' AND id_post = '".$id_post."'" );
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Annulation du vote d'un utilisateur sur un commentaire
function suppr_vote_comm($id_comm,$id_post,$id_user){
  $con = connection();
  $stmt = mysqli_prepare($con, "DELETE FROM vote_commentaire WHERE id_post = '".$id_post."' AND id_user = '".$id_user."' AND id_comm = '".$id_comm."'");
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Check si l'utilisateur a déjà fait le même vote sur un commentaire
function verif_meme_type_vote_comm($id_comm,$id_user,$id_post,$type) {
  $con=connection();
  $q = mysqli_query($con, 'SELECT * FROM vote_commentaire');
  while($tab = mysqli_fetch_assoc($q)){
    if($id_user == $tab['id_user'] && $id_post== $tab['id_post'] && $type == $tab['type'] && $id_comm == $tab['id_comm']){
      mysqli_free_result($q);
      mysqli_close($con);
      return 1;
    }
  }
  mysqli_free_result($q);
  mysqli_close($con);
  return 0;
}

//Check si l'utilisateur a déjà voté mais un vote différent sur un commentaire
function verif_different_type_vote_comm($id_comm,$id_user,$id_post,$type) {
  $con=connection();
  $q = mysqli_query($con, 'SELECT * FROM vote_commentaire');
  while($tab = mysqli_fetch_assoc($q)){
    if($id_user == $tab['id_user'] && $id_post== $tab['id_post'] && $type != $tab['type'] && $id_comm == $tab['id_comm']){
      mysqli_free_result($q);
    	mysqli_close($con);
      return 1;
	  }
  }
  mysqli_free_result($q);
  mysqli_close($con);
  return 0;
}

//Modification d'un dislike en un like sur un commentaire
function modifie_dislike_en_like_comm($id_comm,$id_user,$id_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE vote_commentaire SET type= 'like' WHERE id_user = '".$id_user."' AND id_post = '".$id_post."' AND id_comm = '".$id_comm."'" );
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Modification d'un like en un dislike sur un commentaire
function modifie_like_en_dislike_comm($id_comm,$id_user,$id_post) {
  $con = connection();
  $stmt = mysqli_prepare($con, "UPDATE vote_commentaire SET type= 'dislike' WHERE id_user = '".$id_user."' AND id_post = '".$id_post."' AND id_comm = '".$id_comm."'" );
  mysqli_stmt_execute($stmt);
  mysqli_close($con);
}

//Récupération du lien correspondant à l'id d'un post
function lien_id($id_post){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id_post."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['lien'];
}

//Récupération de la description correspondant à l'id d'un post
function description_id($id_post){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id_post."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['contenu_post'];
}

//Récupération du nombre de likes sur un commentaire
function nbe_like_comm($id_comm){
  $con=connection();
  $query=mysqli_query($con,"SELECT id FROM vote_commentaire WHERE id_comm='".$id_comm."' AND type='like'");
  $a= mysqli_num_rows($query);
  mysqli_close($con);
  return $a;
}

//Récupération du nombre de dislikes sur un commentaire
function nbe_dislike_comm($id_comm){
  $con=connection();
  $query=mysqli_query($con,"SELECT id FROM vote_commentaire WHERE id_comm='".$id_comm."' AND type='dislike'");
  $a=mysqli_num_rows($query);
  mysqli_close($con);
  return $a;
}

//Récupération du nombre de likes sur un post
function nbe_like_post($id_post){
  $con=connection();
  $query=mysqli_query($con,"SELECT id FROM vote_post WHERE id_post='".$id_post."' AND type='like'");
  $a= mysqli_num_rows($query);
  mysqli_close($con);
  return $a;
}

//Récupération du nombre de dislikes sur un post
function nbe_dislike_post($id_post){
  $con=connection();
  $query=mysqli_query($con,"SELECT id FROM vote_post WHERE id_post='".$id_post."' AND type='dislike'");
  $a=mysqli_num_rows($query);
  mysqli_close($con);
  return $a;
}

//Récupération de l'id des posts que l'utilisateur a commenté
function id_my_post_comm($id_user){
  $con=connection();
  $q = mysqli_query($con,"SELECT id_post FROM commentaires WHERE id_user='".$id_user."'");
  $assoc = mysqli_fetch_assoc($q);
  mysqli_free_result($q);
  mysqli_close($con);
  return $assoc;
}

//Récupération de l'id des posts que l'utilisateur a commenté
function id_my_post_vote($id_user){
  $con=connection();
  $q = mysqli_query($con,"SELECT id_post FROM vote_post WHERE id_user='".$id_user."'");
  $assoc = mysqli_fetch_assoc($q);
  mysqli_free_result($q);
  mysqli_close($con);
  return $assoc;
}

// Compte le nombre de commentaires par post et retourne les posts classés par ordre de nombre de commentaires desc
function affiche_post_plus_commente(){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT id_post,COUNT(*) FROM commentaires GROUP BY id_post ORDER BY COUNT(*) DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

//Récupération de la date correspondant au post
function date_post($id){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['date'];
}

//Récupération du lien correspondant au post
function lien_post($id){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['lien'];
}

//Récupération du contenu_post correspondant au post
function contenu_post($id){
  $con=connection();
  $query = mysqli_query($con,"SELECT * FROM posts WHERE id_post='".$id."'");
  $a=mysqli_fetch_assoc($query);
  mysqli_close($con);
  return $a['contenu_post'];
}

//Compte le nombre de votes par post et retourne les posts classés par ordre de nombre de posts desc
function affiche_post_plus_vote(){
  $con = connection();
  $stmt = mysqli_query($con, "SELECT id_post,COUNT(*) FROM vote_post GROUP BY id_post ORDER BY COUNT(*) DESC");
  $assoc=mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  mysqli_free_result($stmt);
  mysqli_close($con);
  return $assoc;
}

?>
