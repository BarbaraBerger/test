<?php  session_start();
  include("fonctions.php");
echo "salut";
$id_post=$_GET['id'];

?>

<form method="post">

<label for="contenu_post"></label><input type="text" class="form-control" id="modification" name='modification' placeholder="Entrez votre nouveau contenu" required/>

<center><input type="submit" class="btn btn-primary" value="Enregistrer modification" /></center>

</form>




<?php
if(isset($_POST['modification'])){
$contenu_post=$_POST['modification'];
modifie_contenu_post($contenu_post,$id_post);

header('Location:post.php?id='.$id_post); 

}


?>

