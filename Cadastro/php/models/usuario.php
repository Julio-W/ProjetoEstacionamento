<?php 

// Inclui o arquivo de configuração do banco de dados
include "../config/database.php";


        $email = $_POST['email'];
        $senha = $_POST['pass']; 
       

        // Verifica se o e-mail já existe no banco de dados
        $sql = "SELECT COUNT(*) AS total FROM usuario WHERE Email = '$email'";
        $result = $conn->query($sql);  // Executa a consulta usando MySQLi

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['total'] > 0) {
                // Se o e-mail já estiver cadastrado, redireciona para login.html com mensagem de erro
                header("Location: ../../../Login/index.html");
                exit();
            }
        }

        // Se o e-mail não estiver cadastrado, cria uma nova conta
        $sql = "INSERT INTO usuario (Email, Senha) VALUES ('$email', '$senha')";
        if ($conn->query($sql) === TRUE) {
            // Redireciona para a página padrão após o cadastro bem-sucedido
            header("Location: ../../../Painel de Controle/index.html");
            exit();
        } else {
            echo "Erro ao inserir dados: " . $conn->error;
        }

// Fecha a conexão com o banco de dados
$conn->close();
?>
