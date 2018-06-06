<!DOCTYPE html>
<html lang="en">

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
  <link href="public/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="public/bootstrap/css/landing-page.css" rel="stylesheet">
  <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">
  <?php if(isset($customScript)) echo $customScript;?>
  </head>
  <body>
    <!-- Navigation -->
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
    <a class="nav-link" href="index.php?action=registration">Inscription</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connexionModalCenter">Connexion</button>

    ');
  }
    ?>


    </div>
  </div>
</nav>
<body>
  <div class="container-fluid" style="min-height:650px">
<?= $content ?>
</div>
</body>
<footer class="footer bg-light">
 <div class="container-fluid">
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
