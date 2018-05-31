<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="jquery/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>
  <!-- Bootstrap core CSS -->
  <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">
  <?php if(isset($customScript)) echo $customScript;?>
  </head>
  <body>
    <!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top justify-content-between border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="icon.png" width="50" height="50">
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
<?= $content ?>

</body>
</html>
