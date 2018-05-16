<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  </head>

  <body>
<form class="form-signin" action="index.php?action=connectMember" method="post">
  <div class="text-center mb-4">
    <h1 class="h3 mb-3 font-weight-normal">Connectez vous</h1>
  </div>
  <div class="form-label-group">
  <input type="text" id="inputLogin" name="email" class="form-control" placeholder="Email" <?php if(isset($_GET['email'])) echo 'value="'.htmlspecialchars($_GET['email']).'"'?> required autofocus>
  <label for="inputEmail">Email</label>
  </div>
  <div class="form-label-group">

  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <label for="inputPassword">Password</label>
  </div>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" name="case" value="connexion-automatique"> Connexion automatique
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
  <p class="mt-5 mb-3 text-muted text-center">Pas encore inscrit ? Inscrivez vous <a href="index.php?action=registration">ici</a></p>
</form>
</body>
