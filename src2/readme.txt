Fonctionnalités
-------------------

Fonctionnalités implémentées :
	--> Au lancement de n'importe quelle page du dossier, redirection vers la page de connexion si l'utilisateur n'est pas connecté.
	--> Inscription : l'utilisateur peut s'inscrire et arrive sur la page d'accueil si tout est correct (pseudo, mail, mdp).
	--> Redirection vers la page inscription depuis la page connexion et vice versa.
	--> Connexion au site : lorsque l'utilisateur se connecte, il arrive sur la page d'accueil.
	--> Ajouter un post
	--> Ajouter un commentaire sur un post
	--> Afficher les posts du plus au moins récent
	--> Commenter un post
	--> Vote : un utilisateur peut voter une seule fois sur un post ou un commentaire. Il peut changer son vote ou l'annuler.
	--> Un utilisateur peut supprimer ses commentaires et ses posts, mais pas ceux des autres.
	--> Un utilisateur peut modifier ses commentaires et les descriptions de ses posts, mais pas ceux des autres.
	--> Déconnexion : un utilisateur peut se déconnecter du site.

Fonctionnalités non implémentées :
	--> Affichage du nombre de vote(s) à côté des commentaires et des posts
	--> Les plus populaires sur la page d'accueil
	--> Liens sur lequels j'ai interagi dans le profil
	--> Déploiement


Architecture
------------------

src/configuration.php : permet de configurer les accès à la base de données, ainsi que le nom du site.

src/install.php : permet de créer les bases de données nécessaires à l'utilisation du site, ainsi que d'ajouter les 2 utilisateurs demandés, le lien, le commentaire et le vote aux bases concernées. Les deux utilisateurs sont : bob@bob (mdp : bobby66) et max@max (mdp : maxou59), pour respecter les contraintes sur l'adresse mail et le mot de passe. 

src/fonctions.php : fichier qui regroupe toutes les fonctions qu'il a été utile de définir pour implémenter le site.

src/style.css : feuille de style du site.

src/accueil.php : page d'accueil de notre site, sur laquelle l'utilisateur peut ajouter un post, visualiser les posts du jour et les posts le plus populaires (et y accéder pour les commenter ou votre en cliquant dessus). Il peut aussi aller sur son profil et se déconnecter depuis cette page.

src/inscription.php : page qui permet à l'utilisateur de s'inscrire sur le site, et qui le redirige vers la page d'accueil après l'inscription (si et seulement si l'inscription est valide).

src/login.php : page qui permet de se connecter et qui le redirige vers la page d'accueil.

src/logout.php : page qui déconnecte l'utilisateur et le redirige vers la page de connexion.

src/post.php : page qui affiche le post demandé par l'utilisateur. IL peut y voter pour ce post mais aussi le commenter et voter pour les commentaires. L'utilisateur peut aussi accéder à la modification et à la suppression du post et/ou des commentaires si ce sont les siens.

src/modifier_comm.php : page où l'utilisateur peut modifier son commentaire. Il peut égaler accéder à la page du post correspond au commentaire qu'il veut modifier. L'utilisateur ne peut pas accéder à cette page pour les commentaires qui ne sont pas les siens.

src/modifier.php : page où l'utilisateur peut modifier son post. Il peut égaler accéder à la page du post correspondant . L'utilisateur ne peut pas accéder à cette page pour les posts qui ne sont pas les siens. 

src/profil.php : page sur laquelle l'utilisateur accède à son profil. Depuis cette page, il peut retourner à la page d'accueil et ce déconnecter. Il peut également visualiser ses posts et ceux dans lesquels il a interagit. Enfin, il peut poster un lien s'il le souhaite.

src/suppression_com.php : page qui sert à supprimer le commentaire d'un utilisateur lorsqu'il le demande (seulement si le commentaire est le sien, sinon il n'accède jamais à cette page). Tous les votes de ce commentaire sont également supprimés. La page redirige automatiquement vers la page du post correspondant.

src/suppression.php : page qui sert à supprimer le post d'un utilisateur lorsqu'il le demande (seulement si le post est le sien, sinon il n'accède jamais à cette page). Tous les votes de ce post, les commentaires du post et leurs votes sont également supprimés. La page redirige automatiquement vers la page d'accueil.

src/vote_comm.php : page qui sert à ajouter le vote d'un utilisateur sur un commentaire. Si il a déjà voté la même chose, un message d'erreur s'affiche sur le commentaire. S'il vote différemment, son vote est mis à jour. Cette page sert aussi à annuler le vote d'un utilisateur s'il le demande.

src/vote_post.php : page qui sert à ajouter le vote d'un utilisateur sur un post. Si il a déjà voté la même chose, un message d'erreur s'affiche sur le post. S'il vote différemment, son vote est mis à jour. Cette page sert aussi à annuler le vote d'un utilisateur s'il le demande.
