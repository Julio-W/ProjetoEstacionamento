<?php

// Verifica se o campo 'nome' existe
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $vagas = $_POST['vagas'];
    $vagasP = $_POST['vagasP'];
    $horaA = $_POST['horaA'];
    $horaF = $_POST['horaF'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verifica se já existe estacionamento com o gerente igual ao usuário logado
    $query = "SELECT * FROM estacionamento WHERE Gerente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Atualiza os dados do estacionamento existente
        $query_update = "UPDATE estacionamento SET Nome=?, QuantidadeDeVagas=?, VagasPreferenciais=?, HorarioAbertura=?, HorarioFechamento=? WHERE Gerente=?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("siissi", $nome, $vagas, $vagasP, $horaA, $horaF, $usuario_id);
        $stmt_update->execute();
        header("Location: ../index.php");
        //exit(); 
    } else {
        // Insere um novo estacionamento com os dados fornecidos, incluindo LimiteComum e LimitePreferencial
        $limiteComum = $vagas; // LimiteComum igual à quantidade de vagas
        $limitePreferencial = $vagasP; // LimitePreferencial igual às vagas preferenciais
        
        $query_insert = "INSERT INTO estacionamento (Nome, QuantidadeDeVagas, VagasPreferenciais, HorarioAbertura, HorarioFechamento, LimiteComum, LimitePreferencial, Gerente) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("siissiii", $nome, $vagas, $vagasP, $horaA, $horaF, $limiteComum, $limitePreferencial, $usuario_id);
        $stmt_insert->execute();
        header("Location: ../index.php");
        // exit();
    }
}
?>
