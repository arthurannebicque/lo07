<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
   <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
        <header class="text-center"></header><h1>Connexion à votre compte</h1></header>
        </div>
        <div class="col-md-offset-5 col-md-3">

        <form class="form-signin" action="index.php?action=connectMember" method="post">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Connectez vous</h1>
            </div>
            <div class="form-label-group form-login">
                <label for="inputEmail">Email</label>
                <input type="text" id="inputLogin" name="email" class="form-control" placeholder="Email" <?php if (isset($_GET['email'])) echo 'value="' . htmlspecialchars($_GET['email']) . '"' ?> required autofocus>

            </div>
            <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="case" value="connexion-automatique"> Connexion automatique
                </label>
            </div>
            <div class="wrapper">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
            <p class="mt-5 mb-3 text-muted text-center">Pas encore inscrit ? Inscrivez vous <a href="index.php?action=registration">ici</a></p>
            </div>
        </form>
        </div>
    </div>
   </div>
    </body>
