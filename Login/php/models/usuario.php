<?php
include "..\config\database.php";

$email = $_POST["email"];
$senha = $_POST["pass"];

// Verifica se o e-mail existe no banco de dados
$sql = "SELECT senha FROM usuario WHERE email = '$email'";
$result = $conn->query($sql);  // Executa a consulta

if ($result->num_rows > 0) {
    // O e-mail foi encontrado no banco de dados
    $row = $result->fetch_assoc();

    // Compara a senha fornecida com a senha do banco de dados
    if ($senha == $row['senha']) {
        // Retorna sucesso para o JavaScript fazer o redirecionamento
        $dados = ['mensagem' => 'Login bem-sucedido', 'status' => 'success', 'email' => "$email"];
        echo json_encode($dados);
    } else {
        // Senha incorreta
        $dados = ['mensagem' => 'A senha está incorreta', 'status' => 'error', 'email' => "$email"];
        echo json_encode($dados);
        header("Location: ../../index.php");
        exit();
    }
} else {
    // O e-mail não foi encontrado
    $dados = ['mensagem' => 'Esse email não está cadastrado', 'status' => 'error', 'email' => ""];
    echo json_encode($dados);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
