<?php  session_start();
include("fonctions.php");
$id_post=$_GET['idp'];
$id_comm=$_GET['idc'];
$type=$_GET['type'];

//Si annuler alors ça efface le vote
if ($type == annuler){
  suppr_vote_comm($id_comm,$id_post,$_SESSION['id_user']);
  header('Location: post.php?annuleok=comm&id='.$id_post.'&idc='.$id_comm);
}
elseif ($type == like){
  if (verif_meme_type_vote_comm($id_comm,$_SESSION['id_user'],$id_post,$type)){
  header('Location: post.php?erreur=likecomm&id='.$id_post.'&idc='.$id_comm);
  }
  elseif (verif_different_type_vote_comm($id_comm,$_SESSION['id_user'],$id_post,$type)) {
  modifie_dislike_en_like_comm($id_comm,$_SESSION['id_user'],$id_post);
  header('Location: post.php?erreur=3&id='.$id_post.'&idc='.$id_comm);
  }
  else {
  add_vote_comm($_SESSION['id_user'],$id_post,$id_comm,$type);
  header('Location: post.php?vote=likecomm&id='.$id_post.'&idc='.$id_comm);
  }
}
elseif ($type == dislike){
  if (verif_meme_type_vote_comm($id_comm,$_SESSION['id_user'],$id_post,$type)){
  header('Location: post.php?erreur=dislikecomm&id='.$id_post.'&idc='.$id_comm);
  }
  elseif (verif_different_type_vote_comm($id_comm,$_SESSION['id_user'],$id_post,$type)) {
  modifie_like_en_dislike_comm($id_comm,$_SESSION['id_user'],$id_post);
  header('Location: post.php?erreur=4&id='.$id_post.'&idc='.$id_comm);
  }
  else {
  add_vote_comm($_SESSION['id_user'],$id_post,$id_comm,$type);
  header('Location: post.php?vote=dislikecomm&id='.$id_post.'&idc='.$id_comm);
  }
}

?>
