<?php  session_start();
include("fonctions.php");
$id_post=$_GET['idp'];
$id_comm=$_GET['idc'];
$type=$_GET['type'];
add_vote_comm($_SESSION['id_user'],$id_post,$id_comm,$type);
header('Location: post.php?id='.$id_post);

?>
