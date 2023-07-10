<!DOCTYPE html>
<html lang="en">
<head>
    <title>CONNEXION</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendors/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendors/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendors/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendors/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendors/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendors/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/css/util.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(/images/br2.jpg);">
<h1 style="color: whitesmoke">CHANGER MOT DE PASSE</h1>
            </div>

            <form class="login100-form validate-form" method="POST" action="/update_login/{{Auth::user()->id }}">
                @csrf

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100">Nouveau Mot de Passe</span>
                    <input class="input100" type="password" name="password" placeholder=" Saisir nouveau mot de passe">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100"> Confirmer Mot de Pass </span>
                    <input class="input100" id="password_confirm" type="password" name="confirm_passe"
                           placeholder="Confirmer mot de passe">
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Changer
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<script src="/vendors/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/vendors/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/vendors/bootstrap/js/popper.js"></script>
<script src="/vendors/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/vendors/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/vendors/daterangepicker/moment.min.js"></script>
<script src="/vendors/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/vendors/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="/js/main.js"></script>

</body>
</html>


