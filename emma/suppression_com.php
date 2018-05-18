<?php  session_start();
  include("fonctions.php");
echo "salut";
$id_com=$_GET['id'];
echo "$id_com";
echo "$id_user";
$id_post=id_post_com($id_com);

	
	

	suppression_comm($id_com);
	header('Location: post.php?id='.$id_post);


?>

