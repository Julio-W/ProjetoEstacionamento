<?php
error_reporting(0);
include "php/config/database.php";

$email = $_POST["email"];
$senha = $_POST["pass"]; // Não hash aqui, faremos a comparação com o hash armazenado

// Prepare o statement para evitar injeção de SQL
$stmt = $conn->prepare("SELECT ID, senha FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        // Autenticação bem-sucedida, iniciar sessão e redirecionar
        session_start();
		session_unset();
        $_SESSION['email'] = $email;
        $_SESSION['logado'] = true;
        $_SESSION['usuario_id'] = $row['ID']; // Agora o ID está disponível
        $usuario_id = $_SESSION['usuario_id'];

        // Fechar o primeiro statement
        $stmt->close();

        // Consulta para verificar o valor da coluna 'classe' do usuário
        $stmt_classe = $conn->prepare("SELECT classe FROM usuario WHERE id = ? LIMIT 1");
        $stmt_classe->bind_param("i", $usuario_id);
        $stmt_classe->execute();
        $stmt_classe->bind_result($classe);
        $stmt_classe->fetch();

        if ($classe == 1) { // Verifica se o valor da coluna 'classe' é true (assumindo que seja 1 para true)
            $_SESSION['classe'] = true;
        } else {
            $_SESSION['classe'] = false;
        }

        // Fechar o segundo statement
        $stmt_classe->close();

        // Redirecionar para a página principal
        header("Location: ../Página Principal/index.php");
        exit();
    } else {
        echo "<script>alert('Senha incorreta.');</script>";
    }
} elseif ($email != "") {
    echo "<script>alert('Email não cadastrado.');</script>";
}

// Fechar o statement e a conexão
$stmt->close();
$conn->close();
?>



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
	
	</style>
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

				<form class="login100-form validate-form"  action="../Login/index.php" method="post">
					<span class="login100-form-title">
						Login
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
	


<!--===============================================================================================-->
	<script src="js/main.js"></script>


</body>
</html>