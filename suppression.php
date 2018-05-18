<?php  session_start();
include("fonctions.php");
echo "salut";
$id_post=$_GET['id'];
suppression_post($id_post);
header('Location: accueil.php');
?>
