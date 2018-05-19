<?php
session_start();
include("fonctions.php");
$id_post=$_GET['id'];
?>
<?php
if(isset($_POST['modification'])){
  $contenu_post=$_POST['modification'];
  modifie_contenu_post($contenu_post,$id_post);
  header('Location:post.php?id='.$id_post);
}

?>

<html>
  <head>
    <meta charset ="utf-8"/>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> <?php echo blogTitle(); ?> </title>
  </head>

  <body>
    <form method="post">
      <label for="contenu_post"></label><input type="text" class="form-control" id="modification" name='modification' placeholder="Entrez votre nouveau contenu" required/>
      <center><input type="submit" class="btn btn-primary" value="Enregistrer modification" /></center>

<?php
echo "<a href= 'vote_post.php?id=$id_post'> <button type='submit' class='btn btn-secondary'> Annuler </button></a> ";
?>


    </form>
  </body>
</html>
