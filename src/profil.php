<?php session_start();
include ("fonctions.php");
include ("configuration.php");
 ?>
<html>
  <head>
    <meta charset ="utf-8"/>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> <?php echo blogTitle(); ?>  </title>
  </head>

  <body>
    <div class="container">
      <div class="border-bottom border-dark">
        <section class='row'>
          <h2  class="col-md-5"> <a href = "accueil.php"> Accueil </a> </h2>
          <h1 class="col-md-5 font-weight-bold"> Bonjour <?php echo $_SESSION['pseudo']; ?> ! </h1>
          <h2  class="col-md-2"> <a href= "logout.php"> Déconnexion </a> </h2>
        </section>
      </div>
      <span class="border border-white "></span>
      <div class="alert alert-success">
        <h1> <p class="text-center"> AJOUTER UN POST </p> </h1>
        <hr size=4 width=66% align=center >
        <form>
          <section class='row'>
            <h1 class="col-md-2"> </h1>
            <h1 class="col-md-8">
              <div class="form-group">
                <label for="lien"></label><input type="url" class="form-control" id="lien" name="lien" aria-describedby="emailHelp" placeholder="lien" required/>
                <label for="contenu_post"></label><input type="text" class="form-control" id="contenu_post" name="contenu_post" aria-describedby="emailHelp" placeholder="contenu_post" required/>
            </h1>
          </section>
          <hr size=4 width=66% align=center >
          <center><button type="submit" class="btn btn-primary">POST</button></center>
        </form>
        </div>
                <?php
                if(isset($_GET['lien'])){
                  $lien=$_GET['lien'];
                  $contenu_post=$_GET['contenu_post'];
                  ajoutPost($_SESSION['id_user'],$lien,$contenu_post);
                }
                ?>
                <section class='row'>
                  <section class="col-6">
                    <header>
                      <center>
                        <h2 class="title"> <span class="badge badge-warning"> Historic view</span> </h2>
                      </center>
                    </header>
                    <div class="border-bottom border-dark">
                    </div>
                  </section>
                  <section class="col-6">
                    <header>
                      <center>
                        <h2> <span class="badge badge-success"> Mes posts </span> </h2>
                      </center>
                    </header>
                    <div class="border-bottom border-dark"></div>
                    <?php
                    $posts=affiche_my_post($_SESSION['id_user']);
                    ?>
                    <?php

                    foreach ($posts as $post){
                    	$id_user = $post['id_user'];
                      $id_post = $post['id_post'];
                    	$pseudo = pseudo_id($id_user);
                    	$date = $post['date'];
                    	$lien = $post['lien'];
                    	$contenu_post = $post['contenu_post'];
                    ?>
                    <hr size=4 width=66% align=center >
                    <?php
                    	echo "<pre>";
                    	echo "$date";
                    	echo "<br>$pseudo,vous avez publié</br>";
                      echo "<a href='post.php?id=$id_post'> Voir le post </a>";
                    	echo "\"$lien\"";
                    	echo "<br>\"$contenu_post\"</br>";
                    	echo "</pre>";
                    }
                    ?>
                  </section>
                </section>
              </section>
            </div>
          </body>
</html>
