Fonctionnalités
-------------------


Fonctionnalités implémentées : 
	
	--> Page d'accueil : un utilisateur non connecté ne peut pas y accéder, il est automatiquement redirigé vers la page de connexion. Sur cette page, les liens ayant les plus de votes et de commentaires sont affichés, ainsi que les liens partagés dans les dernières 24 heures dans l'ordre anti-chronologique.

	--> Inscription : un utilisateur peut s'inscrire en entrant un pseudo de plus de 4 caractères, une adresse mail valide et un mot de passe de plus de 6 caractères. L'utilisateur peut également accéder à la page de connexion depuis la page d'inscription s'il a déjà un compte. Il ne peut pas créer son compte si son pseudo et son mail sont déjà utilisés par un autre utilisateur.

	--> Authentification : un utilisateur peut se connecter à l'aide de son adresse mail et de son mot de passe. Il peut se déconnecter du site. S'il n'est pas connecté, il ne peut pas accéder au site. Enfin, il peut accéder à la page d'inscription depuis la page de connexion s'il n'a pas encore de compte.

	--> Ajouter/Éditer/Supprimer des liens : un utilisateur connecté peut partager un lien avec son commentaire depuis la page d'accueil ainsi que depuis sa page de profil. Lorsque l'utilisateur accède à la page d'un lien, il a la possibilité de supprimer ou de modifier le post, seulement si c'est le sien. S'il le supprime, il est automatiquement redirigé vers la page d'accueil.

	--> Visualiser la page d'un lien : en cliquant sur le lien, un utilisateur accède à la page du post, où il peut visualiser les votes du post, ainsi que les commentaires du post et leurs votes.

	--> Upvote et downvote des liens : depuis la page du lien, un utilisateur a la possibilité de liker ou de disliker un post. Il ne peut voter qu'une seule fois, mais il peut changer son vote ou l'annuler (un message sur la page lui confirme ce qu'il a fait). Les nombres de like(s) et de dislike(s) d'un post sont affichés en dessous du post. 

	--> Commenter un lien : un utilisateur connecté peut commenter les liens du site autant de fois qu'il le souhaite, depuis la page du post. Depuis cette même page, il peut visualiser tous les commentaires du post, et il peut supprimer ou modifier les commentaires qui sont les siens. Il peut également liker ou disliker les commentaires, que ce soient les siens ou non . Il n'a le droit qu'à un seul vote par commentaire mais il peut changer ou annuler son vote, comme il peut le faire avec les posts.

	--> Page de profil : un utilisateur connecté peut accéder à sa page de profil depuis l'accueil ou depuis la page d'un post. Sur cette page, il peut partager un lien avec sa description. Il peut aussi y visualiser ses posts de manière anti-chronologique et les posts dans lesquels il a interagi (vote ou commentaire).

	--> Déploiement : un script permet de déployer le site sur un serveur. Ce script permet l'installation des tables dans une base de données, la création de deux utilisateurs, la création d'un partage de lien, d'un commentaire et d'un upvote. Les deux utilisateurs sont : bob@bob (mdp : bobby66) et max@max (mdp : maxou59), pour respecter les contraintes sur l'adresse mail et le mot de passe. 

	--> Messages d'erreur : l'utilisateur reçoit des messages d'erreur si à l'inscription son pseudo et/ou son mot de passe ne sont pas valides et s'il trompe dans son adresse mail ou son mot de passe lors de la connexion.

	--> Sécurité de l'application : il n'est pas possible d'accéder aux informations d'un utilisateur sans avoir rentrer son mot de passe et son adresse mail avant. Il n'est pas possible pour les utilisateurs de modifier ou de supprimer quelque chose qu'il n'a pas posté.


Fonctionnalités non implémentées : 

	--> Bonus : favoris, catégories.


Architecture
------------------

src/configuration.php : permet de configurer les accès à la base de données, ainsi que le nom du site.

src/install.php : permet le déploiement du site.

src/fonctions.php : fichier qui regroupe toutes les fonctions qu'il a été utile de définir pour implémenter le site.

src/style.css : feuille de style du site.

src/accueil.php : page d'accueil de notre site (inaccessible à tous les utilisateurs qui ne sont pas connectés).

src/inscription.php : page qui permet à l'utilisateur de s'inscrire sur le site.

src/login.php : page qui permet à l'utilisateur de se connecter.

src/logout.php : page qui déconnecte l'utilisateur et le redirige automatiquement vers la page de connexion.

src/post.php : page qui affiche le post demandé par l'utilisateur.

src/modifier_comm.php : page où l'utilisateur peut modifier son commentaire. .

src/modifier.php : page où l'utilisateur peut modifier son post.

src/profil.php : page sur laquelle l'utilisateur accède à son profil. 

src/suppression_com.php : page qui permet à l'utilisateur de supprimer son commentaire et qui le redirige automatiquement vers la page du post correspondant.

src/suppression.php : page qui permet à l'utilisateur de supprimer son post et qui le redirige automatiquement vers la page d'accueil.

src/vote_comm.php : page qui sert à ajouter le vote d'un utilisateur sur un commentaire et qui le redirige automatiquement vers la page du post.

src/vote_post.php : page qui sert à ajouter le vote d'un utilisateur sur un post et qui le redirige automatiquement vers la page du post.

