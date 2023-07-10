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
<script src="{{ url('js/sweetalert1.js') }}"></script>
<script src="{{ url('js/sweetalert2.js') }}"></script>
<script>

</script>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/images/br2.jpg);">
					<span class="login100-form-title-1">
						CONNEXION
					</span>
				</div>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger ">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
				<form class="login100-form validate-form"  method="POST" action="login">
				{{ csrf_field()}}

					<div class="wrap-input100 validate-input m-b-26" data-validate="Nom d'Utilisateur Obligatoire">
						<span class="label-input100">Nom d'Utilisateur</span>
						<input class="input100" type="text" name="username" placeholder="Saisir le nom d'Utilisateur">

					</div>


					<div class="wrap-input100 validate-input m-b-18" data-validate = "Mot de passe Obligatoire">
						<span class="label-input100">Mot de Passe</span>
						<input class="input100" type="password" name="password" placeholder="Saisir le mot de passe">

					</div>


					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">

						</div>

						<div>
							<a href="#" class="txt1">
								Mot de passe Oublié?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"   >
							CONNEXION
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
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
