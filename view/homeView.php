<!DOCTYPE html>
<html lang="fr">


<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="jquery/jquery.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="public/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="public/bootstrap/css/landing-page.css" rel="stylesheet">
  <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">

  <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
  </head>

<nav class="navbar navbar-light bg-light static-top justify-content-between border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="public/images/icon.png" width="50" height="50">
    </a>
    <div class="navbar">
    <a class="nav-link" href="#discover">Découvrir</a>

    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
      echo('
      <a class="nav-link" href="index.php">Profil</a>
      <a type="button" class="btn btn-outline-primary" href="index.php?action=deconnexion">Deconnexion</a>
      ');
  } else {
    echo('
    <button class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#registrationModalCenter">Inscription</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connexionModalCenter">Connexion</button>

    ');
  }
    ?>


    </div>
  </div>
</nav>

<div class="modal fade" id="connexionModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Connectez vous !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-signin" action="index.php?action=connectMember" method="post">
          <div class="form-group">
          <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email" <?php if(isset($_GET['email'])) echo 'value="'.htmlspecialchars($_GET['email']).'"'?> required autofocus>
          </div>
          <div class="form-group">
          <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input class="defaultCheck" type="checkbox" name="case" value="connexion-automatique"> Connexion automatique
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
          <p class="mt-5 mb-3 text-muted text-center">Pas encore inscrit ? Inscrivez vous <a href="index.php">ici</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="registrationModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Inscrivez vous !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 220px">
        <div class="container mt-4">
          <div class="row">
            <div class="col mr-auto   text-center" style="height: 120px">
            <a  href="index.php?action=registration&type=parent">
            <div class="col-12 ml-auto border py-5 text-center" style="height: 120px">
              <h5 class="mx-auto">Parent</h5>
            </div></a>
          </div>
          <div class="col mr-auto  text-center" style="height: 120px">
            <a  href="index.php?action=registration&type=babysitter">
            <div class="col-12 mr-auto border py-5 text-center" style="height: 120px">
              <h5 class="mx-auto">Babysitter</h5>
            </div></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Simplifiez votre recherche de garde d'enfants, essayez Sitties !</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-9 mx-auto">
      <h1 class="mx-auto"><small>Vous êtes :</small></h1>
      </div>
    </div>
    <div class="row">
            <div class="col-3 ml-auto">
              <a class="btn btn-block btn-lg btn-outline-light" href="index.php?action=registration&type=parent">Parent</a>
            </div>
            <div class="col-3 mr-auto">
              <a class="btn btn-block btn-lg btn-outline-light" href="index.php?action=registration&type=babysitter">Babysitter</a>
            </div>
    </div>
  </div>
</header>

<!-- Icons Grid -->
<section class="features-icons bg-light text-center" id="discover">
 <div class="container">
   <div class="row">
     <div class="col-lg-4">
       <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
         <div class="features-icons-icon d-flex">
           <i class="icon-screen-desktop m-auto text-primary"></i>
         </div>
         <h3>Pratique</h3>
         <p class="lead mb-0">Réservez en quelques clics seulement un Babysitter près de chez vous</p>
       </div>
     </div>
     <div class="col-lg-4">
       <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
         <div class="features-icons-icon d-flex">
           <i class="icon-user m-auto text-primary"></i>
         </div>
         <h3>Adapté à vos besoins</h3>
         <p class="lead mb-0">Réservez à la dernière minutes ou bien chaque jour au même horaire, Sitties se plie à votre emploi du temps </p>
       </div>
     </div>
     <div class="col-lg-4">
       <div class="features-icons-item mx-auto mb-0 mb-lg-3">
         <div class="features-icons-icon d-flex">
             <i class="icon-check m-auto text-primary"></i>
         </div>
         <h3>100% confiance</h3>
         <p class="lead mb-0">Choisissez votre Babysitter en fonction des avis laissés par les autres parents</p>
       </div>
     </div>
   </div>
 </div>
</section>


<!-- Image Showcases -->
<section class="showcase ">
 <div class="container-fluid p-0">
   <div class="row no-gutters">
     <div class="col-lg-6 order-lg-2 text-white showcase-img"> <img src="public/images/baby1.jpg" alt="dd"  width=100% ></div>
     <div class="col-lg-6 order-lg-1 my-auto showcase-text">
       <h2>Déja plus de 1500 inscrits en région parisienne</h2>
       <p class="lead mb-0">Rejoignez la communauté Sitties, comprennant plus de 1500 membres actifs, et choisissez dès aujourd'hui le Babysitter adapté à vos besoins.</p>
     </div>
   </div>
   <div  class="row no-gutters">
     <div class="col-lg-6 text-white showcase-img"><img src="public/images/baby2.png" alt="dd" width="100%" ></div>
     <div class="col-lg-6 my-auto showcase-text">
       <h2>Une grande variété de choix</h2>
       <p class="lead mb-0">Parlant anglais, chinois ou bien portugais, expérimenté ou non, aide aux devoirs ou non, nous avons quelqu'un pour vous.</p>
     </div>
   </div>
   <div class="row no-gutters">
     <div class="col-lg-6 order-lg-2 text-white showcase-img"><img src="public/images/baby4.png" alt="dd" width="100%"  ></div>
     <div class="col-lg-6 order-lg-1 my-auto showcase-text">
       <h2>Nous nous occupons de tout</h2>
       <p class="lead mb-0">Réservez quand vous voulez, et organisez votre emploi du temps dès le début de chaque semaine car chaque parent mérite du temps pour lui</p>
     </div>
   </div>
 </div>
</section>

<!-- Testimonials -->
<section class="testimonials text-center bg-light">
 <div class="container">
   <h2 class="mb-5">Ce que les gens disent de nous...</h2>
   <div class="row">
     <div class="col-lg-4">
       <div class="testimonial-item mx-auto mb-5 mb-lg-0">
         <img class="img-fluid rounded-circle mb-3" src="public/images/isa.jpg" alt="">
         <h5>Margaret E.</h5>
         <p class="font-weight-light mb-0">"Babysitters pro, horaires à la demande et j'en passe. N'hésitez plus !"</p>
       </div>
     </div>
     <div class="col-lg-4">
       <div class="testimonial-item mx-auto mb-5 mb-lg-0">
         <img class="img-fluid rounded-circle mb-3" src="public/images/frederic.jpg" alt="">
         <h5>Fred S.</h5>
         <p class="font-weight-light mb-0">"Parfait pour un papa un peu occupé par son travail. Voilà un an que nous sommes fidèles clients !"</p>
       </div>
     </div>
     <div class="col-lg-4">
       <div class="testimonial-item mx-auto mb-5 mb-lg-0">
         <img class="img-fluid rounded-circle mb-3" src="public/images/sarah.png" alt="">
         <h5>Sarah	W.</h5>
         <p class="font-weight-light mb-0">"Grâce à Sitties, j'ai pu trouver une babysitter parlant francais et chinois : une perle !"</p>
       </div>
     </div>
   </div>
 </div>
</section>

<!-- Call to Action -->
<section class="call-to-action text-white text-center">
 <div class="overlay"></div>
 <div class="container">
   <div class="row">
     <div class="col-xl-9 mx-auto">
       <h2 class="mb-4">Pret à vous lancer ? Inscrivez vous maintenant !</h2>
     </div>
     <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
       <div class="row">
               <div class="col-3 ml-auto">
                 <a class="btn btn-block btn-lg btn-outline-light" href="index.php?action=registration&type=parent">Parent</a>
               </div>
               <div class="col-3 mr-auto">
                 <a class="btn btn-block btn-lg btn-outline-light" href="index.php?action=registration&type=babysitter">Babysitter</a>
               </div>
       </div>
     </div>
   </div>
 </div>
</section>

<!-- Footer -->
<footer class="footer bg-light">
 <div class="container">
   <div class="row">
     <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
       <ul class="list-inline mb-2">
         <li class="list-inline-item">
           <a href="#">About</a>
         </li>
         <li class="list-inline-item">&sdot;</li>
         <li class="list-inline-item">
           <a href="#">Contact</a>
         </li>
         <li class="list-inline-item">&sdot;</li>
         <li class="list-inline-item">
           <a href="#">Terms of Use</a>
         </li>
         <li class="list-inline-item">&sdot;</li>
         <li class="list-inline-item">
           <a href="#">Privacy Policy</a>
         </li>
       </ul>
       <p class="text-muted small mb-4 mb-lg-0">&copy; Sitties 2018. All Rights Reserved.</p>
     </div>
     <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
       <ul class="list-inline mb-0">
         <li class="list-inline-item mr-3">
           <a href="#">
             <i class="fa fa-facebook fa-2x fa-fw"></i>
           </a>
         </li>
         <li class="list-inline-item mr-3">
           <a href="#">
             <i class="fa fa-twitter fa-2x fa-fw"></i>
           </a>
         </li>
         <li class="list-inline-item">
           <a href="#">
             <i class="fa fa-instagram fa-2x fa-fw"></i>
           </a>
         </li>
       </ul>
     </div>
   </div>
 </div>
</footer>
</html>
