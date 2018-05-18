<?php  session_start();
include("fonctions.php");
$id_post=$_GET['id'];
suppr_tous_comm($id_post);
suppression_post($id_post);
header('Location: accueil.php?ok');
?>
