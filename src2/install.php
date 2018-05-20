<?php

include("fonctions.php");

$q1 = "CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL CHECK (CHARACTER_LENGTH(VALUE) >= 4),
  `mail` varchar(255) NOT NULL CHECK (mail LIKE '%@%'),
  `mdp` varchar(25) NOT NULL CHECK (CHARACTER_LENGTH(VALUE) >= 6),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB;";

$q2 = "CREATE TABLE IF NOT EXISTS `posts`(
  `id_post`int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `lien` VARCHAR(255) CHECK (lien like 'www.%'),
  `contenu_post` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  FOREIGN KEY (`id_user`) REFERENCES `utilisateurs`(`id_user`)
)ENGINE=InnoDB;";

$q3 = "CREATE TABLE IF NOT EXISTS `commentaires`(
  `id_comm` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post`int(11) NOT NULL,
  `contenu_comm` text,
  PRIMARY KEY (`id_comm`),
  FOREIGN KEY (`id_user`) REFERENCES `utilisateurs`(`id_user`),
  FOREIGN KEY (`id_post`) REFERENCES `posts`(`id_post`)
)ENGINE=InnoDB;";

$q4 = "CREATE TABLE IF NOT EXISTS `vote_post`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post`int(11) NOT NULL,
  `type` VARCHAR(255),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_user`) REFERENCES `utilisateurs`(`id_user`),
  FOREIGN KEY (`id_post`) REFERENCES `posts`(`id_post`)
)ENGINE=InnoDB;";

$q5 = "CREATE TABLE IF NOT EXISTS `vote_commentaire`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post`int(11) NOT NULL,
  `id_comm`int(11) NOT NULL,
  `type` VARCHAR(255),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_user`) REFERENCES `utilisateurs`(`id_user`),
  FOREIGN KEY (`id_post`) REFERENCES `posts`(`id_post`),
  FOREIGN KEY (`id_comm`) REFERENCES `commentaires`(`id_comm`)
)ENGINE=InnoDB;";

$q6 = "INSERT INTO utilisateurs (pseudo,mail,mdp) VALUES ('bobby','bob@bob','bobby66')";
$q7 = "INSERT INTO utilisateurs (pseudo,mail,mdp) VALUES ('maxou','max@max','maxou59')";
$q8 = "INSERT INTO posts (id_user,lien,contenu_post) VALUES ('2','http://google.fr','Allez checker ce site !')";
$q9 = "INSERT INTO commentaires (id_user,id_post,contenu_comm) VALUES ('1','1','Excellent site pour faire des recherches !')";
$q10 = "INSERT INTO vote_commentaire (id_user,id_post,id_comm,type) VALUES ('2','1','1','like')";

$q11 = "DROP TABLE IF EXISTS utilisateurs";
$q12 = "DROP TABLE IF EXISTS posts";
$q13 = "DROP TABLE IF EXISTS commentaires";
$q14 = "DROP TABLE IF EXISTS vote_post";
$q15 = "DROP TABLE IF EXISTS vote_commentaire";

echo "Connexion au serveur.<br>";

$c = connection();

echo "Suppression des tables si elles existent déjà.<br>";

mysqli_query($c, $q15);
echo mysqli_info($c);
echo mysqli_error($c);

mysqli_query($c, $q14);
echo mysqli_info($c);
echo mysqli_error($c);

mysqli_query($c, $q13);
echo mysqli_info($c);
echo mysqli_error($c);

mysqli_query($c, $q12);
echo mysqli_info($c);
echo mysqli_error($c);

mysqli_query($c, $q11);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table utilisateurs.<br>";

mysqli_query($c, $q1);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table posts.<br>";
mysqli_query($c, $q2);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table commentaires.<br>";
mysqli_query($c, $q3);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table vote pour les posts.<br>";
mysqli_query($c, $q4);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table vote pour les commentaires.<br>";
mysqli_query($c, $q5);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Ajout des utilisateurs par défaut.<br>";

mysqli_query($c,$q6);
echo mysqli_info($c);
echo mysqli_error($c);

mysqli_query($c,$q7);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Ajout du post.<br>";
mysqli_query($c,$q8);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Ajout du commentaire.<br>";
mysqli_query($c,$q9);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Ajout du upvote.<br>";
mysqli_query($c,$q10);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Déconnexion du serveur.";

mysqli_close($c);


?>
