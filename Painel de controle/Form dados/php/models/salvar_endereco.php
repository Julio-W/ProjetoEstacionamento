<?php

include 'php/config/database.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] === false) {
  header("Location: ../../Login/index.php");
  exit();
}

if (!isset($_SESSION['classe']) || $_SESSION['classe'] !== true) {
  header("Location: ../../Página Principal/index.php?redirecionado=sim");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cep'])) {
        // Verifique se cada chave existe antes de usá-la
        $cep = $_POST['cep'] ?? null;
        $rua = $_POST['address'] ?? null;
        $numero = $_POST['number'] ?? null;
        $complemento = $_POST['complement'] ?? null;
        $bairro = $_POST['neighborhood'] ?? null;
        $cidade = $_POST['city'] ?? null;
        $estado = $_POST['region'] ?? null;
        $usuario_id = $_SESSION['usuario_id'] ?? null;

        // Verifique a conexão com o banco de dados
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Atualiza o endereço com base no usuário (gerente)
        $query = "SELECT * FROM estacionamento WHERE Gerente = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $query_update = "UPDATE estacionamento SET CEP=?, Rua=?, Bairro=?, Cidade=?, Estado=?, Numero=?, Complemento=? WHERE Gerente=?";
            $stmt_update = $conn->prepare($query_update);
            $stmt_update->bind_param("sssssssi", $cep, $rua, $bairro, $cidade, $estado, $numero, $complemento, $usuario_id);
            if ($stmt_update->execute()) {
                echo "<script>alert('Endereço atualizado com sucesso!')</script>";
            } else {
                echo "<script>alert('Erro ao atualizar o endereço.')</script>";
            }
        } else {
            echo "<script>alert('Cadastre o estacionamento primeiro')</script>";
            header("Location: ../index.php");
            exit();
        }
    }
}
?>
