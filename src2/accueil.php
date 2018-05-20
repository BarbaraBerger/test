<?php session_start();

include ("fonctions.php");
include ("configuration.php");

if (!isset($_SESSION['mail'])) {
  header('Location: login.php');
}

if(isset($_GET['lien'])){
  $lien=$_GET['lien'];
  $contenu_post=$_GET['contenu_post'];
  ajoutPost($_SESSION['id_user'],$lien,$contenu_post);
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
      <div style="float: left" id='lien'> <a href= "profil.php"> Profil </a> </div>
      <div style="float: right" id='lien'> <a href= "logout.php"> Déconnexion </a> </div>
      <br> <br>
      <h3> Accueil </h3> </br>
      <section class="jumbotron" id='4'>
        <section class='row'>
          <div class="col-md-2"> </div>
          <div class="col-md-8">
            <div class="form-group">
              <form action = "accueil.php" method = "get">
                <h2 class="text-center"> Exprimez-vous ! </h2>
                <hr size=4 width=75% align=center >
                <input type="url" class="form-control" name="lien" aria-describedby="emailHelp" placeholder="Entrez le lien que souhaitez partager" required/>
 		            <input type="text" class="form-control" name="contenu_post" aria-describedby="emailHelp" placeholder="Description" required/> <br>
                <center><button type="submit" class="btn btn-primary">POST</button></center>
              </form>
            </div>
          </div>
        </section>
      </section>
      <?php
      if (isset($_GET['ok'])){
        echo "<center> <div id='suppr'> Votre post a bien été supprimé ! </div></center>";
      }
      ?> <br>
      <section class='row'>
        <section class="col-6">
          <header>
            <center>
              <h2 class="title"> <span class="badge"> Ce qu'il s'est passé aujourd'hui : </span> </h2>
            </center>
          </header>
          <div class="border-bottom border-dark"> </div> <br>
          <?php
            $posts=affiche_post_recent();
            foreach ($posts as $post){
            	$id_user = $post['id_user'];
              $id_post = $post['id_post'];
              $pseudo = pseudo_id($id_user);
            	$date = $post['date'];
            	$lien = $post['lien'];
            	$contenu_post = $post['contenu_post'];
          ?>
          <section class="jumbotron" id='5'>
          <?php echo "<div id='pseudo'>$pseudo a partagé : </div>";
          	echo "<div id='date'>$date</div>";
          	echo "<div id='post'><a href='$lien'>$lien</a></div>";
          	echo "<div id='description'>$contenu_post</div><br>";
            echo "<div id='votes'> 3 upvotes - 2 downvotes </div><br>";
            echo "<div style='float: right'><a href='post.php?id=$id_post'> Voir le post </a></div>";
          ?>
          </section>
          <?php } ?>
        </section>
        <section class="col-6">
          <header>
            <center>
              <h2 class="title"> <span class="badge"> Liens les plus commentés : </span> </h2>
            </center>
          </header>
          <div class="border-bottom border-dark"> </div> <br>
          <?php
            $posts=affiche_post_plus_commente();////
            foreach ($posts as $post){
              
              $id_post = $post['id_post'];
	      $id_user = id_user_post($id_post);
              $pseudo = pseudo_id($id_user);
              $date = date_post($id_post);
              $lien = lien_post($id_post);
              $contenu_post = contenu_post($id_post);
          ?>
          <section class="jumbotron" id='5'>
            <?php echo "<div id='pseudo'>$pseudo a partagé : </div>";
              echo "<div id='date'>$date</div>";
              echo "<div id='post'><a href='$lien'>$lien</a></div>";
              echo "<div id='description'>$contenu_post</div><br>";
              echo "<div id='votes'> 3 upvotes - 2 downvotes </div><br>";
              echo "<div style='float: right'><a href='post.php?id=$id_post'> Voir le post </a></div>";
            ?>
          </section>
          <?php } ?>



<header>
            <center>
              <h2 class="title"> <span class="badge"> Liens avec le plus de votes : </span> </h2>
            </center>
          </header>
          <div class="border-bottom border-dark"> </div> <br>
          <?php
            $posts=affiche_post_plus_vote();////
            foreach ($posts as $post){
              
              $id_post = $post['id_post'];
	      $id_user = id_user_post($id_post);
              $pseudo = pseudo_id($id_user);
              $date = date_post($id_post);
              $lien = lien_post($id_post);
              $contenu_post = contenu_post($id_post);
          ?>
          <section class="jumbotron" id='5'>
            <?php echo "<div id='pseudo'>$pseudo a partagé : </div>";
              echo "<div id='date'>$date</div>";
              echo "<div id='post'><a href='$lien'>$lien</a></div>";
              echo "<div id='description'>$contenu_post</div><br>";
              echo "<div id='votes'> 3 upvotes - 2 downvotes </div><br>";
              echo "<div style='float: right'><a href='post.php?id=$id_post'> Voir le post </a></div>";
            ?>
          </section>
          <?php } ?>


        </section>
      </section>
    </div>
  </body>
</html>
