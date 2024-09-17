<!DOCTYPE html>
<html lang="en">
<head>
	<title>SmartPark</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="vLogo">
				<a href="../index.html" class="seta"><img src="../images/botao-de-seta-para-a-esquerda-do-teclado.png" alt=""></a>
				<div class="login100-pic js-tilt" data-tilt>
					<a href="../index.html" ><img src="../images/logo escrita sem fundo.png" alt="IMG" class="logoL"></a>
					<a href="../index.html" ><img src="../images/texto-logo.png" alt="IMG" class="logoE"></a>
				</div>
			</div>

				<form class="login100-form validate-form"  action="php/models/usuario.php" method="post">
					<span class="login100-form-title">
						Login
					</span>

					<span class="login100-form-title" id="resultado"></span>
						oi:
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<a ><button type="submit"  class="login100-form-btn">
							Login
						</button></a>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Ou cadastre-se
						</span>
						<a class="txtC" href="../Cadastro/index.php">
							aqui
						</a>
					</div>

					<div class="text-center p-t-136">
						<span class="txt1">
							Redefina a sua senha
						</span>
						<a class="txtC" href="../Forgot/index.php">
							aqui
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/alertas.js"></script>


<!--===============================================================================================-->
	<script src="js/main.js"></script>


</body>
</html>