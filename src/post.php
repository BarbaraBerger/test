<?php
  include("fonctions.php");
  session_start();
  if (isset($_GET['id'])) {
    $id_post = $_GET['id'];
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
  }

  if (isset($_GET['error'])) {
    $msg = "Vous ne pouvez pas supprimer ce post !";
    $id_post = $_GET['error'];
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
  }


?>
<html>
<body>
<?php echo "<h1> $msg </h1>"; ?>
<h2  class="col-md-2"> <a href= "accueil.php"> Retour à l'accueil </a> </h2>
<h2  class="col-md-2"> <a href= "profil.php"> Profil </a> </h2>
<?php echo "<a href='suppression.php?id=$id_post'> Supprimer </a>"; ?>
</body>
</html>
