<?php  session_start();
include("fonctions.php");
$id_post=$_GET['id'];
$type=$_GET['type'];
add_vote_post($_SESSION['id_user'],$id_post,$type);
header('Location: post.php?id='.$id_post);

?>
