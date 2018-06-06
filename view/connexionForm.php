<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="jquery/jquery.min.js"></script>
        <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="public/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
        <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>

    <body class="form-parent">
   <div class="container mt-5 pt-5">



        <form class="form pt-5 w-75 mx-auto justify-content-md-center" action="index.php?action=connectMember" method="post">
          <div class="text-center mb-4">
              <h1 class="text-white">Connectez vous</h1>
          </div>
            <div class="form-group row justify-content-md-center">
            <div class="col-3">
                <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email" <?php if (isset($_GET['email'])) echo 'value="' . htmlspecialchars($_GET['email']) . '"' ?> required autofocus>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
                <div class="col-3">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
            <div class="checkbox mb-3">
                <label class="text-white">
                    <input type="checkbox" name="case" value="connexion-automatique"> Connexion automatique
                </label>
            </div>
          </div>
          <div class="form-group row justify-content-md-center">
            <div class="col-5">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
          </div>
        </div>
        </form>
        <div class="col-3 mx-auto">
    <a type="button" class="btn btn-outline-light btn-block" href="index.php">Retour</a>
  </div>
        </div>
    </div>
   </div>
    </body>
