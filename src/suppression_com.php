<?php  session_start();
include("fonctions.php");
$id_com=$_GET['id'];
$id_post=id_post_com($id_com);
remove_vote_comm($id_com);
suppression_comm($id_com);
header('Location: post.php?id='.$id_post);
?>
