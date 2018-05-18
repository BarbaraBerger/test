<?php  session_start();
include("fonctions.php");
echo "salut";
$id_post=$_GET['id'];
$id_user = id_user_post($id_post);
if ($_SESSION['id_user'] == $id_user){
  suppression_post($id_post);
  header('Location: accueil.php?ok');
} else{
  header('Location: post.php?error='.$id_post);
}
?>
