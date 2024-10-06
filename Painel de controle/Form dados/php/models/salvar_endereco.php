<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se cada chave existe antes de usá-la
    $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
    $rua = isset($_POST['address']) ? $_POST['address'] : null;
    $numero = isset($_POST['number']) ? $_POST['number'] : null;
    $complemento = isset($_POST['complement']) ? $_POST['complement'] : null;
    $bairro = isset($_POST['neighborhood']) ? $_POST['neighborhood'] : null;
    $cidade = isset($_POST['city']) ? $_POST['city'] : null;
    $estado = isset($_POST['region']) ? $_POST['region'] : null;
    $usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

    // Verifique se o usuário está logado
    if ($usuario_id === null) {
        echo json_encode(["success" => false, "message" => "Usuário não está logado."]);
        exit;
    }

    // Atualiza o endereço com base no usuário (gerente)
    // Verifica se já existe estacionamento com o gerente igual ao usuário logado
    $query = "SELECT * FROM estacionamento WHERE Gerente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $query_update = "UPDATE estacionamento SET CEP=?, Cidade=?, Estado=?, Numero=?, Complemento=? WHERE Gerente=?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("sssisi", $cep, $cidade, $estado, $numero, $complemento, $usuario_id);
        $stmt_update->execute();
    } else {
        echo json_encode(["success" => false, "message" => "Cadastre o estacionamento primeiro."]);
    }
}
?>
