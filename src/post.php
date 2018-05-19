<?php
session_start();
include("fonctions.php");

if (isset($_GET['id'])) {
  $id_post = $_GET['id'];
}

$id_user = id_user_post($id_post);

if (isset($_GET['erreur'])){
  if ($_GET['erreur']==likepost){
    $erreur_post = "Vous avez déjà upvoté ce post.";
  }
  if ($_GET['erreur']==dislikepost){
    $erreur_post = "Vous avez déjà downvoté ce post.";
  }
  if ($_GET['erreur']==likecomm){
    $erreur_comm = "Vous avez déjà upvoté ce commentaire.";
  }
  if ($_GET['erreur']==dislikecomm){
    $erreur_comm = "Vous avez déjà downvoté ce commentaire.";
  }
  if ($_GET['erreur']==1){
    $erreur_post = "Votre vote a bien été modifié en upvote.";
  }
  if ($_GET['erreur']==2){
    $erreur_post = "Votre vote a bien été modifié en downvote.";
  }
  if ($_GET['erreur']==3){
    $erreur_comm = "Votre vote a bien été modifié en upvote.";
  }
  if ($_GET['erreur']==4){
    $erreur_comm = "Votre vote a bien été modifié en downvote.";
  }
}

if (isset($_GET['annuleok'])){
  if ($_GET['annuleok']==post){
    $msg_post = "Votre vote a bien été annulé.";
  }
  if ($_GET['annuleok']==comm){
    $msg_comm = "Votre vote a bien été annulé.";
  }
}
if (isset($_GET['vote'])){
  if ($_GET['vote'] == likepost){
    $msg_vote_post = "Vous avez upvoté ce post.";
  }
  if ($_GET['vote'] == dislikepost){
    $msg_vote_post = "Vous avez downvoté ce post.";
  }
  if ($_GET['vote'] == likecomm){
    $msg_vote_comm = "Vous avez upvoté ce commentaire.";
  }
  if ($_GET['vote'] == dislikecomm){
    $msg_vote_comm = "Vous avez downvoté ce commentaire.";
  }
}

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
echo "<a href= 'vote_post.php?id=$id_post&type=like'> <button type='submit' class='btn btn-secondary'> Upvote </button></a> <a href= 'vote_post.php?id=$id_post&type=dislike'> <button type='submit' class='btn btn-secondary'> Downvote </button> </a> <a href= 'vote_post.php?id=$id_post&type=annuler'> <button type='submit' class='btn btn-secondary'> Annuler mon vote </button> </a>";

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
      <?php if (isset($erreur_post)){
        echo "$erreur_post";
      }
      if (isset($msg_post)){
        echo "$msg_post";
      }
      if (isset($msg_vote_post)){
        echo "$msg_vote_post";
      }
      ?>
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
      <h1> <p class="text-center"> Donnez votre avis sur ce lien ! </p> </h1>
      <form method="post">
        <section class='row'>
          <h1 class="col-md-2"> </h1>
          <h1 class="col-md-8">
            <div class="form-group">
              <label for="contenu_comm"></label><input type="text" class="form-control"  name="contenu_comm" placeholder="Commentaire" required/>
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
    echo "<a href= 'vote_comm.php?idp=$id_post&type=like&idc=$id_comm'> <button type='submit' class='btn btn-secondary'> Upvote </button></a> <a href= 'vote_comm.php?idp=$id_post&type=dislike&idc=$id_comm'> <button type='submit' class='btn btn-secondary'> Downvote </button> </a> <a href= 'vote_comm.php?idp=$id_post&type=annuler&idc=$id_comm'> <button type='submit' class='btn btn-secondary'> Annuler mon vote </button> </a><br>";

    if (isset($_GET['idc'])){
      if ($_GET[idc]==$id_comm){
        if (isset($erreur_comm)){
          echo "$erreur_comm";
        }
        if (isset($msg_comm)){
          echo "$msg_comm";
        }
        if (isset($msg_vote_comm)){
          echo "$msg_vote_comm";
        }
      }
    }

    echo "<hr size=4 width=66% align=center >";
    if($_SESSION['id_user'] == $id_user){
      echo "<a href= 'suppression_com.php?id=$id_comm'> <button type='submit' class='btn btn-primary'> Supprimer le commentaire</button></a> <a href= 'modifier_comm.php?id=$id_comm'> <button type='submit' class='btn btn-primary'> Modification </button> </a>";
    } ?>
    <hr size=4 width=66% align=center >

  <?php } ?>
  </body>
</html>
