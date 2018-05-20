<?php session_start();

include("fonctions.php");

if (!isset($_SESSION['mail'])) {
  header('Location: login.php');
}

$id_comm=$_GET['id'];
$id_post = id_post_com($id_comm);
$contenu_com=id_com($id_comm);

if(isset($_POST['modification'])){
  $contenu_comm=$_POST['modification'];
  modifie_contenu_comm($contenu_comm,$id_comm);
  header('Location: post.php?id='.$id_post);
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
        echo "<div id='lien'><a href= 'post.php?id=$id_post'> Retour au post </a></div>";
        echo "<hr size=4 width=75% align=center ><br>";
        echo "<h4> Le commentaire que vous souhaitez modifier est : $contenu_com ";
      ?>
      <br><br>
      <form method="post">
        <label for="contenu_post"></label><input type="text" class="form-control" id="modification" name='modification' placeholder="Entrez votre nouveau commentaire" required/><br>
        <center><input type="submit" class="btn btn-primary" value="Enregistrer modification" /></center>
      </form>
    </div>
  </body>
</html>
