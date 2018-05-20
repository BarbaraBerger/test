<?php  session_start();

include("fonctions.php");

if (!isset($_SESSION['mail'])) {
  header('Location: login.php');
}

$id_post=$_GET['id'];
$type = $_GET['type'];

if ($type == annuler){
  suppr_vote_post($id_post,$_SESSION['id_user']);
  header('Location: post.php?annuleok=post&id='.$id_post);
}
elseif ($type == like){
  if (verif_meme_type_vote_post($_SESSION['id_user'],$id_post,$type)){
  header('Location: post.php?erreur=likepost&id='.$id_post);
  }
  elseif (verif_different_type_vote_post($_SESSION['id_user'],$id_post,$type)) {
  modifie_dislike_en_like_post($_SESSION['id_user'],$id_post);
  header('Location: post.php?erreur=1&id='.$id_post);
  }
  else {
  add_vote_post($_SESSION['id_user'],$id_post,$type);
  header('Location: post.php?vote=likepost&id='.$id_post);
  }
}
elseif ($type == dislike){
  if (verif_meme_type_vote_post($_SESSION['id_user'],$id_post,$type)){
  header('Location: post.php?erreur=dislikepost&id='.$id_post);
  }
  elseif (verif_different_type_vote_post($_SESSION['id_user'],$id_post,$type)) {
  modifie_like_en_dislike_post($_SESSION['id_user'],$id_post);
  header('Location: post.php?erreur=2&id='.$id_post);
  }
  else {
  add_vote_post($_SESSION['id_user'],$id_post,$type);
  header('Location: post.php?vote=dislikepost&id='.$id_post);
  }
}
?>
