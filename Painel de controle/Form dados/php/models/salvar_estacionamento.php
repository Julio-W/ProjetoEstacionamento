<?php
// Verifica se o campo 'nome' existe
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $vagas = $_POST['vagas'];
    $vagasP = $_POST['vagasP'];
    $horaA = $_POST['horaA'];
    $horaF = $_POST['horaF'];
    $usuario_id = $_SESSION['usuario_id'];
    $ValorHora = $_POST['ValorHora'];

    // Verifica se já existe estacionamento com o gerente igual ao usuário logado
    $query = "SELECT * FROM estacionamento WHERE Gerente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Estacionamento já existe, recupera os dados atuais
        $estacionamento = $result->fetch_assoc();
        $cep = $estacionamento['CEP'];  // Supondo que os campos são 'cep', 'complemento', 'cidade', 'estado', 'numero'
        $complemento = $estacionamento['Complemento'];
        $cidade = $estacionamento['Cidade'];
        $estado = $estacionamento['Estado'];
        $numero = $estacionamento['Numero'];
        $limiteComum = $vagas - $vagasP; // LimiteComum igual à quantidade de vagas menos as preferenciais
        $limitePreferencial = $vagasP;
        
        // Atualiza os dados do estacionamento, sem alterar cep, complemento, cidade, estado ou numero
        $query_update = "UPDATE estacionamento SET Nome=?, QuantidadeDeVagas=?, VagasPreferenciais=?, HorarioAbertura=?, HorarioFechamento=?, ValorHora=?, LimiteComum=?, LimitePreferencial=? WHERE Gerente=?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("siissiiii", $nome, $vagas, $vagasP, $horaA, $horaF, $ValorHora, $limiteComum, $limitePreferencial, $usuario_id);
        $stmt_update->execute();
        header("Location: ../index.php");
        exit(); 
    } else {
        // Insere um novo estacionamento com os dados fornecidos, incluindo LimiteComum e LimitePreferencial
        $limiteComum = $vagas - $vagasP; // LimiteComum igual à quantidade de vagas menos as preferenciais
        $limitePreferencial = $vagasP; // LimitePreferencial igual às vagas preferenciais
        
        $query_insert = "INSERT INTO estacionamento (Nome, QuantidadeDeVagas, VagasPreferenciais, HorarioAbertura, HorarioFechamento, LimiteComum, LimitePreferencial, ValorHora, Gerente, CEP, Complemento, Cidade, Estado, Numero) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("siissiiiiissss", $nome, $vagas, $vagasP, $horaA, $horaF, $limiteComum, $limitePreferencial, $ValorHora, $usuario_id, $cep, $complemento, $cidade, $estado, $numero);
        $stmt_insert->execute();
        header("Location: ../index.php");
        exit();
    }
}
?>
