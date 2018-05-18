Fonctionnalités
-------------------

Fonctionnalités implémentées :
	--> Au lancement de la page d'accueil, redirection vers la page de connexion si l'utilisateur n'est pas connecté.
	--> Inscription : l'utilisateur peut s'inscrire et atterrit directement sur la page d'accueil si tout est correct (pseudo, mail, mdp).
	--> Connexion : on peut se connecter + redirection vers l'accueil.
	--> Ajouter un post dans la table
	--> Afficher les posts du plus au moins récent
	--> Redirection vers un page pour le post sur lequel on clique pour pouvoir le commenter et voter

Fonctionnalités non implémentées :
	--> like/dislike


Architecture
------------------

src/configuration.php : permet de configurer les accès à la base de données.

src/install.php : permet de créer les bases de données nécessaires à l'utilisation du site, les 2 utilisateurs demandés ainsi que le lien, le commentaire et le vote. Les deux utilisateurs sont : bob@bob (mdp : bobby66) et max@max (mdp : maxou59), pour respecter les contraintes d'inscription. 

src/fonctions.php : fichier qui regroupe toutes les fonctions qu'il a été utile de définir pour implémenter le site.

src/style.css : feuille de style pour le site.

src/accueil.php : page d'accueil de notre site.

src/inscription.php : page qui permet à l'utilisateurs de s'inscrire sur le site.

src/login.php : page qui permet de se connecter.

src/logout.php : page qui déconnecte l'utilisateur.

src/post.php : page qui affiche le post demandé par l'utilisateur.
