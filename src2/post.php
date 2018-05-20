<?php
session_start();
include("fonctions.php");
if (!isset($_SESSION['mail'])) {
  header('Location: login.php');
}
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
if(isset($_POST['contenu_comm'])){
  $contenu_comm=$_POST['contenu_comm'];
  ajoutCom($_SESSION['id_user'],$id_post,$contenu_comm);
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
      <div style="float: left" id='lien'> <a href= "accueil.php"> Retour à l'accueil </a> </div>
      <div style="float: right" id='lien'> <a href= "profil.php"> Profil </a> </div>
      <br> <br>
      <section>
      <?php
        $assoc = affiche_post($id_post);
        echo "<pre>";
        foreach ($assoc as $assocs){
          $id_user = $assocs['id_user'];
          $pseudo = pseudo_id($id_user);
          $lien = $assocs['lien'];
          $contenu_post = $assocs['contenu_post'];
          $date = $assocs['date'];
      ?>
        <section class="jumbotron" id='6'>
        <?php
          echo "<div id='pseudop'>Post de $pseudo :</div>";
          echo "<div id='datep'>$date</div>";
          echo "<div id='postp'><a href='$lien'>$lien</a></div>";
          echo "<div id='descriptionp'>$contenu_post</div><br>";
          echo "<div id='votesp'> 3 upvotes - 2 downvotes </div><br>";
          if ($id_user == $_SESSION['id_user']){
            echo "<div style='float: right'><a href= 'modifier.php?id=$id_post'><button type='submit' class='btnp'> Modifier mon post </button></a></div> <div style='float: left'><a href='suppression.php?id=$id_post'><button type='submit' class='btnp'> Supprimer mon post </button> </a> </div>";
          }
        ?>
        </section>
        <?php }
          echo "<center><a href= 'vote_post.php?id=$id_post&type=like'> <button type='submit' class='btns upvote'> Upvote </button></a> <a href= 'vote_post.php?id=$id_post&type=dislike'> <button type='submit' class='btns downvote'> Downvote </button> </a> <a href= 'vote_post.php?id=$id_post&type=annuler'> <button type='submit' class='btns annulevote'> Annuler mon vote </button> </a></center><br>";
          if (isset($erreur_post)){
            echo "<center><div id='suppr'>$erreur_post</div></center>";
          }
          if (isset($msg_post)){
            echo "<center><div id='suppr'>$msg_post</div></center>";
          }
          if (isset($msg_vote_post)){
            echo "<center><div id='suppr'>$msg_vote_post</div></center>";
          }
        ?>
      </section>
      <section class="jumbotron" id='7'>
        <h2 class="text-center"> Donnez votre avis sur ce lien ! </h2>
        <section class='row'>
          <div class="col-md-2"> </div>
          <div class="col-md-8">
            <div class="form-group">
              <form method = "post">
                <hr size=4 width=75% align=center >
                <input type="text" class="form-control" name="contenu_comm" placeholder="Commentaire" required/><br>
                <center><button type="submit" class="btn btn-primary">Envoyer le commentaire</button></center>
              </form>
            </div>
          </div>
        </section>
      </section>
      <?php
        $comms=affiche_com_post($id_post);
        foreach ($comms as $com){
          $id_post = $com['id_post'];
          $id_user = $com['id_user'];
          $id_comm = $com['id_comm'];
          $pseudo = pseudo_id($id_user);
        	$contenu_comm = $com['contenu_comm'];
      ?>
      <section class="jumbotron" id='8'>
      <?php
        echo "<div id='pseudoc'>$pseudo a commenté : $contenu_comm</div><br>";
        if ($id_user == $_SESSION['id_user']){
          echo "<div style='float: right'><a href= 'modifier_comm.php?id=$id_comm'><button type='submit' class='btnp'> Modifier mon commentaire </button></a></div> <div style='float: left'><a href='suppression_com.php?id=$id_comm'><button type='submit' class='btnp'> Supprimer le commentaire </button> </a> </div> <br><br>";
        }
        echo "<center><a href= 'vote_comm.php?idp=$id_post&type=like&idc=$id_comm'> <button type='submit' class='btns upvote'> Upvote </button></a> <a href= 'vote_comm.php?idp=$id_post&type=dislike&idc=$id_comm'> <button type='submit' class='btns downvote''> Downvote </button> </a> <a href= 'vote_comm.php?idp=$id_post&type=annuler&idc=$id_comm'> <button type='submit' class='btns annulevote'> Annuler mon vote </button> </a> <br> <br>";
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
      ?>
      </section>
      <?php } ?>
    </div>
  </body>
</html>
