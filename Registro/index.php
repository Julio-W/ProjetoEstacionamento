<?php 
error_reporting(0);

// Inclui o arquivo de configuração do banco de dados
include "php/config/database.php";

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] === false) {
    header("Location: ../Login/index.php");
    exit();
}

// Obtém o ID do usuário logado
$idUsuario = $_SESSION['usuario_id'];

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['telefone']) && isset($_POST['datadenascimento'])) {
    
    // Coleta os dados enviados pelo usuário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $datadenascimento = $_POST['datadenascimento'];

    // Consulta SQL para atualizar os dados
    $sql = "UPDATE usuario SET Nome = ?, DataDeNascimento = ?, Telefone = ?, CPF = ? WHERE ID = ?";

    // Prepara a consulta usando prepared statements
    if ($stmt = $conn->prepare($sql)) {
        // Associa os parâmetros aos tipos corretos (todos são strings, exceto o ID que é inteiro)
        $stmt->bind_param("ssssi", $nome, $datadenascimento, $telefone, $cpf, $idUsuario);

        // Executa a consulta
        if ($stmt->execute()) {
            $_SESSION["CadastroFinalizado"] = true;
            header("Location: ../Página Principal/index.php");
            exit();
        } else {
            echo "Erro ao atualizar dados: " . $stmt->error;
        }

        // Fecha o statement
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
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
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="vLogo">
                    <a href="../Página Principal/index.html" class="seta"><img src="../images/botao-de-seta-para-a-esquerda-do-teclado.png" alt=""></a>
                    <div class="login100-pic js-tilt" data-tilt>
                        <a href="../index.html"><img src="../images/logo escrita sem fundo.png" alt="IMG" class="logoL"></a>
                        <a href="../Página Principal/index.php"><img src="../images/texto-logo.png" alt="IMG" class="logoE"></a>
                    </div>
                </div>

                <form class="login100-form validate-form" action="" method="post">
                    <span class="login100-form-title">Cadastro</span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="nome" placeholder="Nome" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" 
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
                        <button class="login100-form-btn" type="submit">Atualizar cadastro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });
    </script>
    <script src="js/main.js"></script>
</body>
</html>
