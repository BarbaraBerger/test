<?php session_start(); /* First start a session */ ?>
<!doctype html>
<html>
<head>
  <meta charset ="utf-8"/>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title> Moke reddit </title>
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
    <form>
        <section class='row'>
           <h1 class="col-md-2"> </h1>
           <h1 class="col-md-8">
             <div class="form-group">
               <label for="addPost"></label>

               <input type="text" class="form-control" id="AddPost" aria-describedby="emailHelp" placeholder="Add your POST">

             </div>
          </h1>
        </section>

        <hr size=4 width=66% align=center >
        <center><button type="submit" class="btn btn-primary">POST</button></center>
    </form>
  </div>




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
       <h2> <span class="badge badge-success">My POSTS </span> </h2>
     </center>
     </header>
     <div class="border-bottom border-dark">
     </div>
   </section>


  </section>
    </section>
</div>
</body>
</html>
