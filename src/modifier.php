<?php session_start();

include("fonctions.php");

if (!isset($_SESSION['mail'])) {
  header('Location: login.php');
}

$id_post=$_GET['id'];
$lien=lien_id($id_post);
$description=description_id($id_post);

if(isset($_POST['modificationdes'])){
  if (isset($_POST['modificationlien'])){
    $lien=$_POST['modificationlien'];
    modifie_contenu_lien($lien,$id_post);
  }
  $contenu_post=$_POST['modificationdes'];
  modifie_contenu_post($contenu_post,$id_post);
  header('Location:post.php?id='.$id_post);
}

?>

<html>
  <head>
    <meta charset ="utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <title> <?php echo blogTitle(); ?> </title>
  </head>

  <body>
    <div class="container w-75">
      <br>
      <?php
        echo "<div id='lien'><a href= 'post.php?id=$id_post'> Retour au post </a></div> ";
        echo "<hr size=4 width=75% align=center ><br>";
        echo "<h4> Le description que vous souhaitez modifier est : '$description' que vous aviez écrite à propos du site <a href='$lien'>$lien</a> ";
      ?>
      <br> <br>
      <form method="post">
        <input type="url" class="form-control" id="modification" name='modificationlien' placeholder="Entrez la nouvelle description pour votre lien" required/><br>
        <input type="text" class="form-control" id="modification" name='modificationdes' placeholder="Entrez la nouvelle description pour votre lien" required/><br>
        <center><input type="submit" class="btn btn-primary" value="Enregistrer modification" /></center>
      </form>
    </div>
  </body>
</html>
