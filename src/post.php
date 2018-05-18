<?php
session_start();
include("fonctions.php");

if (isset($_GET['id'])) {
  $id_post = $_GET['id'];
}

$id_user = id_user_post($id_post);


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
echo "<a href= 'vote_post.php?id=$id_post&type=like'> <button type='submit' class='btn btn-secondary'> Upvote </button></a> <a href= 'vote_post.php?id=$id_post&type=dislike'> <button type='submit' class='btn btn-secondary'> Downvote </button> </a>";

?>
<?php
if(isset($_POST['contenu_comm'])){
  $contenu_comm=$_POST['contenu_comm'];
  ajoutCom($_SESSION['id_user'],$id_post,$contenu_comm);
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
    <section>
    <h2  class="col-md-2"> <a href= "accueil.php"> Retour à l'accueil </a> </h2>
    <h2  class="col-md-2"> <a href= "profil.php"> Profil </a> </h2>
    <?php
    if ($id_user == $_SESSION['id_user']){
      echo "<h2  class='col-md-2'> <a href= 'modifier.php?id=$id_post'> Modifier </a> </h2>";
      echo "<a href='suppression.php?id=$id_post'><button type='submit' class='btn btn-primary'> Supprimer le post </button> </a>";
    }
    ?>
  </section>
    <div class="alert alert-success">
      <h1> <p class="text-center"> Ajouter un commentaire </p> </h1>
      <form method="post">
        <section class='row'>
          <h1 class="col-md-2"> </h1>
          <h1 class="col-md-8">
            <div class="form-group">
              <label for="contenu_comm"></label><input type="text" class="form-control" id="contenu_comm" name="contenu_comm" placeholder="contenu_comm" required/>
            </div>
          </h1>
        </section>
        <hr size=4 width=66% align=center >
        <center><button type="submit" class="btn btn-primary">Envoyer le commentaire</button></center>
      </form>
    </div>

    <?php
    $comms=affiche_com_post($id_post);
    foreach ($comms as $com){
      $id_comm = $com['id_comm'];
    	$id_user = $com['id_user'];
      $id_post = $com['id_post'];
      $pseudo = pseudo_id($id_user);
    	$contenu_comm = $com['contenu_comm'];

    echo "<br>$pseudo a publié</br>";
    echo "<br>\"$contenu_comm\"</br>";
    echo "<a href= 'vote_comm.php?idp=$id_post&type=like&idc=$id_comm'> <button type='submit' class='btn btn-secondary'> Upvote </button></a> <a href= 'vote_comm.php?idp=$id_post&type=dislike'&idc=$id_comm> <button type='submit' class='btn btn-secondary'> Downvote </button> </a><br>";
    echo "<hr size=4 width=66% align=center >";
    if($_SESSION['id_user'] == $id_user){
      echo "<a href= 'suppression_com.php?id=$id_comm'> <button type='submit' class='btn btn-primary'> Supprimer le commentaire</button></a> <a href= 'modifier_comm.php?id=$id_comm'> <button type='submit' class='btn btn-primary'> Modification </button> </a>";
    } ?>
    <hr size=4 width=66% align=center >

  <?php } ?>
  </body>
</html>
