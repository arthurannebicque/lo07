<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="public/jquery/jquery.min.js"></script>
  <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top justify-content-between border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?action=showHome">
      <img src="public/images/icon.png" width="50" height="50">
    </a>
    <div class="navbar">
      <a class="nav-link" href="index.php?action=showHome">Découvrir</a>

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
<!-- Connexion Modal -->
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
<!-- Registration Modal -->
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
            <div class="col mr-auto  text-center" style="height: 120px">
              <a  href="index.php?action=registration&type=parent">
                <div class="col-12 ml-auto border py-5 text-center" style="height: 120px">
                  <h5 class="mx-auto">Parent</h5>
                </div>
              </a>
            </div>
            <div class="col mr-auto  text-center" style="height: 120px">
              <a  href="index.php?action=registration&type=babysitter">
                <div class="col-12 mr-auto border py-5 text-center" style="height: 120px">
                  <h5 class="mx-auto">Babysitter</h5>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<body>
  <div class="container-fluid" style="min-height:650px">
    <?php
    if ($_SESSION['type'] == 3) {
      if (isset($_GET['revenu'])) {
        if ($_GET['revenu'] == 'trimestriel') {
          $periode = "des trois derniers mois";
          $revenu = $revenuTrimestrielGlobal[0];
        }
        if ($_GET['revenu'] == 'annuel') {
          $periode = "de l'année en cours";
          $revenu = $revenuAnnuelGlobal[0];
        }
        if ($_GET['revenu'] == 'mensuel') {
          $periode = "du mois";
          $revenu = $revenuMensuelGlobal[0];
        }
      }
      else {
        $periode = "du mois";
        $revenu = $revenuMensuelGlobal[0];
      }
    }?>
    <?php
    if (isset($babysitter) && $_SESSION['type'] == 1 && !$babysitter['candidature_valide']) {?>

      <div class="container-fluid p-5" style="min-height:650px">
        <div class="row justify-content-md-center m-5">
          <h1>Votre candidature n'a pas encore été validée</h1>
        </div>
        <div class="row justify-content-md-center m-5">
          <img src="public/images/teddy.png" width="30%">
        </div>
        <div class="row justify-content-md-center">
          <a type="button" class="btn btn-outline-primary" href="index.php?action=showHome">Retour</a>
        </div>
      </div>
    <?php } else { ?>
      <div class="container-fluid mt-3">
        <div class="row justify-content-md-center">
          <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
              <div class="panel panel-heading">
                <div class="row justify-content-md-center">
                  <?php if ($_SESSION['type'] == 1) echo "<span>Disponibilité</span>";?>
                  <?php if ($_SESSION['type'] == 2) echo "<span>Réservation</span>";?>
                  <?php if ($_SESSION['type'] == 3) echo "<span>Nombre de candidature</span>";?>
                </div>
                <div class="row justify-content-md-center">
                  <?php if ($_SESSION['type'] == 1) echo "<a class='huge' href='index.php?action=disponibilite&type=simple'>Simple</a>";?>
                  <?php if ($_SESSION['type'] == 2) echo "<a class='huge' href='index.php?action=reservation&type=ponctuelle'>Ponctuelle</a>";?>
                  <?php if ($_SESSION['type'] == 3) echo "<a class='huge' href='index.php'>".$applicationCount[0]."</a>";?>
                </div>
                <?php if ($_SESSION['type'] == 3) echo "<br>";?>
              </div>
              <?php if ($_SESSION['type'] == 3) {?>
                <div class="panel-footer text-center">
                  <a href="index.php">Voir plus</a>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
              <div class="panel panel-heading">
                <div class="row justify-content-md-center">
                  <?php if ($_SESSION['type'] == 1) echo "<span class='invisible'>Dispo<span>";?>
                    <?php if ($_SESSION['type'] == 2) echo "<span>Réservation</span>";?>
                    <?php if ($_SESSION['type'] == 3) echo "<span>Chiffre d'affaire ".$periode."<span>";?>
                    </div>
                    <div class="row justify-content-md-center">
                      <?php if ($_SESSION['type'] == 1) echo "<a class='huge' href='index.php'>Accueil</a>";?>
                      <?php if ($_SESSION['type'] == 2) echo "<a class='huge' href='index.php?action=reservation&type=reguliere'>Régulière</a>";?>
                      <?php if ($_SESSION['type'] == 3) echo "<a class='huge' href='index.php?action=showRevenuList'>".$revenu."€</a>";?>
                    </div>
                    <div class="row justify-content-md-center">
                      <?php if ($_SESSION['type'] == 3) echo "<a href='index.php?revenu=mensuel'>Mensuel</a><a href='index.php?revenu=trimestriel'> Trimestriel </a> <a href='index.php?revenu=annuel'> Annuel</a>";?>
                    </div>
                  </div>
                  <?php if ($_SESSION['type'] == 3) {?>
                    <div class="panel-footer text-center">
                      <a href="index.php?action=showRevenuList">Voir plus</a>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                  <div class="panel panel-heading">
                    <div class="row justify-content-md-center">
                      <?php if ($_SESSION['type'] == 1) echo "<span>Disponibilité</span>";?>
                      <?php if ($_SESSION['type'] == 2) echo "<span>Réservation</span>";?>
                      <?php if ($_SESSION['type'] == 3) echo "<span>Nombre de babysitters inscrits</span>";?>
                    </div>
                    <div class="row justify-content-md-center">
                      <?php if ($_SESSION['type'] == 1) echo "<a class='huge' href='index.php?action=disponibilite&type=recurrente'>Récurrente</a>";?>
                      <?php if ($_SESSION['type'] == 2) echo "<a class='huge' href='index.php?action=reservation&type=langue'>Par langue</a>";?>
                      <?php if ($_SESSION['type'] == 3) echo "<a class='huge' href='index.php?action=showSearchForm'>".$babysitterCount[0]."</a>";?>
                    </div>
                    <?php if ($_SESSION['type'] == 3) echo "<br>";?>
                  </div>
                  <?php if ($_SESSION['type'] == 3) {?>
                    <div class="panel-footer text-center">
                      <a href="index.php?action=showSearchForm">Voir plus</a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?= $content ?>
      </div>
    </body>
    <!-- Footer -->
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
