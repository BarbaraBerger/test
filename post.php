<?php
  include("fonctions.php");
  session_start();
  if (isset($_GET['id'])) {
    $id_post = $_GET['id'];
  }

  echo "$id_post";
?>
