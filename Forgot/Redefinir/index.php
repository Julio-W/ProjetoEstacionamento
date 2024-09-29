<?php
// Verifica se o formulário foi enviado e se o campo "email" não está vazio
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["email"])) {

    include "../php/config/database.php";

    $email = $_POST["email"];
    $senha_nova = $_POST["newpass"]; // Nova senha que será atualizada no banco de dados
    $senha_antiga = $_POST["oldpass_cod"]; // Recebe a senha antiga ou o código "123456"

    // Prepare a consulta para buscar a senha antiga armazenada no banco de dados
    $stmt = $conn->prepare("SELECT ID, senha FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifica se a senha antiga fornecida corresponde à senha no banco de dados ou se o código é "123456"
        if (password_verify($senha_antiga, $row['senha']) || $senha_antiga === "123456") {
            // Se a senha antiga ou código estiver correto, atualiza a senha nova
            $nova_senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT); // Hash da nova senha
            
            // Atualiza a senha no banco de dados
            $stmt_update = $conn->prepare("UPDATE usuario SET senha = ? WHERE ID = ?");
            $stmt_update->bind_param("si", $nova_senha_hash, $row['ID']);
            
            if ($stmt_update->execute()) {
                echo "<script>alert('Senha atualizada com sucesso.');</script>";
                // Redirecionar após a atualização
                header("Location: ../../Página Principal/index.php");
                exit();
            } else {
                echo "<script>alert('Erro ao atualizar a senha.');</script>";
            }
            
            $stmt_update->close();
        } else {
            echo "<script>alert('Senha antiga incorreta ou código inválido.');</script>";
        }
    } else {
        echo "<script>alert('Email não cadastrado.');</script>";
    }

    $stmt->close();
    $conn->close();
}
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
				<a href="../index.html" class="seta"><img src=".. ../images/botao-de-seta-para-a-esquerda-do-teclado.png" alt=""></a>
				<div class="login100-pic js-tilt" data-tilt>
					<a href="../../index.html" ><img src="../../images/logo escrita sem fundo.png" alt="IMG" class="logoL"></a>
					<a href="../../index.html" ><img src="../../images/texto-logo.png" alt="IMG" class="logoE"></a>
				</div>
			</div>

				<form class="login100-form validate-form"  action="../Redefinir/index.php" method="post">
					<span class="login100-form-title">
						Alterar Senha
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name="oldpass_cod" placeholder="Senha antiga ou códido">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="newpass" placeholder="Nova senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<a ><button type="submit"  class="login100-form-btn">
							Alterar
						</button></a>
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