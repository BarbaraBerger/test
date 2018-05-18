<?php session_start(); /* First start a session */

include ("fonctions.php");
include ("configuration.php");

if (!isset($_SESSION['mail'])) { //si on ouvre le site sans être connecté, on accède à rien
  header('Location: login.php');
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
    <div class="container">
      <div class="border-bottom border-dark">
        <section class='row'>
          <h2  class="col-md-5"> <a href= "profil.php"> Profil </a> </h2>
          <h1 class="col-md-5 font-weight-bold"> Accueil </a> </h1>
          <h2  class="col-md-2"> <a href= "logout.php"> Déconnexion </a> </h2>

        </section>
      </div>
      <span class="border border-white "></span>
      <?php if (isset($_GET['ok'])){
              echo "Post supprimé !";
            }
      ?>
      <div class="alert alert-success">
        <h1> <p class="text-center"> Ajouter un post </p> </h1>
        <hr size=4 width=66% align=center >
        <form action="accueil.php" method="post">
          <section class='row'>
           <h1 class="col-md-2"> </h1>
           <h1 class="col-md-8">
             <div class="form-group">
               <label for="lien"></label><input type="url" class="form-control" id="lien" name="lien" aria-describedby="emailHelp" placeholder="Entrez le lien que souhaitez partager" required/>
		           <label for="contenu_post"></label><input type="text" class="form-control" id="contenu_post" name="contenu_post" aria-describedby="emailHelp" placeholder="Description" required/>
             </div>
           </h1>
         </section>
         <center><button type="submit" class="btn btn-primary">POST</button></center>
       </form>
     </div>
     <?php
      if(isset($_POST['lien'])){
        $lien=$_POST['lien'];
        $contenu_post=$_POST['contenu_post'];
        ajoutPost($_SESSION['id_user'],$lien,$contenu_post);
      }
      ?>

      <section class='row'>
        <section class="col-6">
          <header>
            <center>
              <h2 class="title"> <span class="badge badge-success"> Day's POSTS </span> </h2>
            </center>
          </header>
          <div class="border-bottom border-dark"> </div>
          <?php
            $posts=affiche_post_recent();
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
            	echo "<br>$pseudo a publié</br>";
            	echo "\"$lien\"";
            	echo "<br>\"$contenu_post\"</br>";
              echo "<a href='post.php?id=$id_post'> Voir le post </a>";
            	echo "</pre>";
            }
          ?>
        </section>
        <section class="col-6">
          <header>
            <center>
              <h2> <span class="badge badge-danger">POPULAR</span> </h2>
            </center>
          </header>
          <div class="border-bottom border-dark"></div>
          <?php
            $assoc = affiche_post_recent();
            echo "<pre>";
            foreach($assoc as $assocs){
              $id_post = $assocs['id_post'];
              $id_user = $assocs['id_user'];
              $pseudo = pseudo_id($id_user);
              $lien = $assocs['lien'];
              $contenu_post = $assocs['contenu_post'];
              $date = $assocs['date'];
          ?>
          <hr size=4 width=66% align=center >
          <?php
              echo "<pre>";
              echo "$date";
            	echo "<br>$pseudo a publié</br>";
            	echo "\"$lien\"";
            	echo "<br>\"$contenu_post\"</br>";
              echo "<a href='post.php?id=$id_post'> Voir le post </a>";
              echo "</pre>";
            }
          ?>
        </section>
      </section>
    </div>
  </body>
</html>
