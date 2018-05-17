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
    `nb_like` int CHECK (nb_like > 0),
    `nb_dislike` int CHECK (nb_dislike > 0),
    PRIMARY KEY (`id_post`),
    FOREIGN KEY (`id_user`) REFERENCES `utilisateurs`(`id_user`)
)ENGINE=InnoDB;";

$q3 = "CREATE TABLE IF NOT EXISTS `commentaires`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post`int(11) NOT NULL,
  `contenu_comm` text,
  `nb_like` int CHECK (nb_like > 0),
  `nb_dislike` int CHECK (nb_dislike > 0),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_user`) REFERENCES `utilisateurs`(`id_user`),
  FOREIGN KEY (`id_post`) REFERENCES `posts`(`id_post`)
)ENGINE=InnoDB;";

echo "Connexion au serveur.";

$c = connection();

echo "Création de la table utilisateurs.";

mysqli_query($c, $q1);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table posts.";
mysqli_query($c, $q2);
echo mysqli_info($c);
echo mysqli_error($c);

echo "Création de la table commentaires.";
mysqli_query($c, $q3);
echo mysqli_info($c);
echo mysqli_error($c);

mysqli_close($c);


?>
