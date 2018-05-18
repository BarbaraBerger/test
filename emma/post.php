<?php  session_start();
  include("fonctions.php");
 
  if (isset($_GET['id'])) {
    $id_post = $_GET['id'];
  }

  echo "$id_post";


  $assoc = affiche_post($id_post);

  echo "<pre>";
  foreach ($assoc as $assocs){
  $id_user = $assocs['id_user'];
  $pseudo = pseudo_id($id_user);
  $lien = $assocs['lien'];
  $contenu_post = $assocs['contenu_post'];
  $date = $assocs['date'];
  echo "$id_user $pseudo $lien $contenu_post $date";
}
  echo "</pre>";

?>


<html>
<head>
  <meta charset ="utf-8"/>
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title> <?php echo blogTitle(); ?> </title>
</head>
<body>
<h2  class="col-md-2"> <a href= "accueil.php"> Retour à l'accueil </a> </h2>
<h2  class="col-md-2"> <a href= "profil.php"> Profil </a> </h2>
<?php

echo "<h2  class='col-md-2'> <a href= 'modifier.php?id=$id_post'> Modifier </a> </h2>";
?>

<?php

echo "<h2  class='col-md-2'> <a href= 'suppression.php?id=$id_post'> <button type='submit' class='btn btn-primary'> Supprimer </button></a> </h2>";
?>

<div class="alert alert-success">
    <h1> <p class="text-center"> Ajouter un commentaire </p> </h1>
    <form method="post">
        <section class='row'>
           <h1 class="col-md-2"> </h1>
           <h1 class="col-md-8">
             <div class="form-group">

		<label for="contenu_comm"></label><input type="text" class="form-control" id="contenu_comm" name="contenu_comm" aria-describedby="emailHelp" placeholder="contenu_comm" required/>

             </div>
          </h1>
        </section>

        <hr size=4 width=66% align=center >
        <center><button type="submit" class="btn btn-primary">Envoyer le commentaire</button></center>
    </form>
  </div>

<?php

if(isset($_POST['contenu_comm'])){



$contenu_comm=$_POST['contenu_comm'];

ajoutCom($_SESSION['id_user'],$id_post,$contenu_comm);
}
?>

<?php

$comms=affiche_com_post($_SESSION['id_user'],$id_post);

foreach ($comms as $com){

	$id_user = $com['id_user'];
  $id_post = $com['id_post'];
  $pseudo = pseudo_id($id_user);
	
	
	$contenu_comm = $com['contenu_comm'];
?>
 <hr size=4 width=66% align=center >
<?php
echo "<br>$pseudo a publié</br>";
echo "<br>\"$contenu_comm\"</br>";
}
?>


</body>
</html>
