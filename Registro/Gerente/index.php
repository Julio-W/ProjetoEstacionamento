<?php
error_reporting(0);
session_start();

// Inclui o arquivo de configuração do banco de dados
include "php/config/database.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] === false) {
    // Redireciona para a página de login
    header("Location: ../Login/index.php");
    exit();
}

// Obtém o ID do usuário logado
$idUsuario = $_SESSION['usuario_id'];

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['cpf'], $_POST['telefone'], $_POST['datadenascimento'], $_POST['codigo'])) {
    
    // Coleta os dados enviados pelo usuário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $datadenascimento = $_POST['datadenascimento'];
    $codigo = $_POST['codigo'];

    // Verifica se o código fornecido é "123456"
    if ($codigo === '123456') {
        // Consulta SQL para atualizar os dados e atribuir Classe = 'true'
        $sql = "UPDATE usuario SET Nome = ?, DataDeNascimento = ?, Telefone = ?, CPF = ?, Classe = true WHERE ID = ?";

        // Prepara a consulta usando prepared statements
        if ($stmt = $conn->prepare($sql)) {
            // Associa os parâmetros (todos são strings, exceto o ID que é inteiro)
            $stmt->bind_param("ssssi", $nome, $datadenascimento, $telefone, $cpf, $idUsuario);

            // Executa a consulta
            if ($stmt->execute()) {
                // Redireciona após o sucesso
                $_SESSION["CadastroFinalizado"] = true;
                header("Location: ../../Página Principal/index.php");
                exit();
            } else {
                echo "Erro ao atualizar dados: " . $stmt->error;
            }

            // Fecha o statement
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        // Exibe mensagem de erro se o código for incorreto
        echo "<script>alert('Código incorreto! A atualização não foi realizada.');</script>";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>SmartPark - Atualizar Cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
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
                    <a href="../index.php" class="seta">
                        <img src="../image/botao-de-seta-para-a-esquerda-do-teclado.png" alt="Voltar">
                    </a>
                    <div class="login100-pic js-tilt" data-tilt>
                        <a href="../../index.html"><img src="../image/logo escrita sem fundo.png" alt="Logo" class="logoL"></a>
                        <a href="../Página Principal/index.php"><img src="../image/texto-logo.png" alt="Logo" class="logoE"></a>
                    </div>
                </div>

                <!-- Formulário de Cadastro -->
                <form class="login100-form validate-form" action="" method="post">
                    <span class="login100-form-title">Atualizar Cadastro</span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="nome" placeholder="Nome" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" 
                               title="Digite um CPF no formato: xxx.xxx.xxx-xx" required placeholder="CPF">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input type="tel" id="telefone" name="telefone" class="input100" required placeholder="Nº telefone">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input type="number" id="codigo" name="codigo" class="input100" required placeholder="Código Gerente">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="date" name="datadenascimento" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">Atualizar cadastro</button>
                    </div>

                    <div class="text-center p-t-136">
                        <span class="txt1"></span>
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
