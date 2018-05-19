<?php  session_start();
include("fonctions.php");
$id_post=$_GET['id'];
$type=$_GET['type'];
$id_vote=id_vote_post($id_post,$_SESSION['id_user']);


//S'il a deja voté, et qu'il tente de refaire le même vote, alors il se passe rien 
if(verif_meme_type_vote_post($_SESSION['id_user'],$id_post,$type)){

	header('Location: post.php?id='.$id_post);
	echo " déjà voté ceci"; //il faut faire ta methode du $msg pour que ca apparaissent sur la meme comme t'as fait pour "post supprimé
}

// S'il a déjà voté et qu'il veut changer son vote (UPTADE dans la table)
//mais ca marche pas 
if(verif_different_type_vote_post($_SESSION['id_user'],$id_post,$type)){
	if($type == 'like'){
		modifie_like_en_dislike($_SESSION['id_user'],$id_post);
	}
}

// S'il n'a pas deja voté il vote 
if(verif_vote_post($_SESSION['id_user'],$id_post)){
add_vote_post($_SESSION['id_user'],$id_post,$type);
header('Location: post.php?id='.$id_post);
}


	// Soit il tente de changer son vote et on le change UPTADE dans la table





?>
