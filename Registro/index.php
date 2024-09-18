<?php 
#error_reporting(0);
// Inclui o arquivo de configuração do banco de dados
include "php/config/database.php";

session_start();

if ($_SESSION['logado'] === false || $_SESSION['logado'] === null ) {
	
	// Redireciona para a página padrão após o cadastro bem-sucedido
	header("Location: ../Login/index.php");
	exit();
}

$idUsuario = $_SESSION['usuario_id'];

// Prepara os dados para a atualização
if ($_POST['nome'] != null) {
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$telefone = $_POST['telefone'];
	$datadenascimento = $_POST['datadenascimento'];
	
	// Cria a consulta SQL para atualizar os dados
	$sql = "UPDATE `usuario` SET `Nome` = '?', `DataDeNascimento` = '?', `Telefone` = '878' WHERE `usuario`.`ID` = 120;";
	
	// Prepara a consulta usando prepared statements para evitar SQL injection
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("siis", $nome, $cpf, $telefone, $datadenascimento);
	
	// Executa a consulta
	if ($stmt->execute()) {
		echo "Dados atualizados com sucesso!";
	} else {
		echo "Erro ao atualizar dados: " . $stmt->error;
	}
}
// Fecha a conexão com o banco de dados
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
	<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="vLogo">
					<a href="../Página Principal/index.html" class="seta"><img src="../images/botao-de-seta-para-a-esquerda-do-teclado.png" alt=""></a>
					<div class="login100-pic js-tilt" data-tilt>
						<a href="../index.html" ><img src="../images/logo escrita sem fundo.png" alt="IMG" class="logoL"></a>
						<a href="../Página Principal/index.php" ><img src="../images/texto-logo.png" alt="IMG" class="logoE"></a>
					</div>
				</div>

				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Cadastro
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nome" placeholder="Nome">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="cpf" 
						pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" 
						title="Digite um CPF no formato: xxx.xxx.xxx-xx" required placeholder="CPF">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input type="tel" id="telefone" name="telefone" class="input100" required placeholder="Nº telefone">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="date" name="datadenascimento" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Concluir cadastro
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1"></span>
						<a class="txt2" href="#"></a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#"></a>
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
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		});
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>
