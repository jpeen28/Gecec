<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>GECEC MINDDEVEL | Se Connecter</title>
</head>
<body class="img js-fullheight" style="background-image: url(img/img1.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <img src="img/cmr.png" style="width: 100px; height: 112px; margin-left: 33%;">
                        <h3 class="mb-4 text-center">GECEC MINDDEVEL</h3>
                        <form action="authentification.php" class="signin-form" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Nom Utilisateur" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" name="password" class="form-control" placeholder="Mot de Passe" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Se Connecter</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Se Souvenir de Moi
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Mot de Passe Oublié</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>