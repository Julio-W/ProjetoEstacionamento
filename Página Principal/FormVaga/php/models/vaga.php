<?php

include("php/config/database.php");
 // Inicie a sessão se não estiver já iniciada

$idUsuario = $_SESSION["usuario_id"];

// Verifique se o formulário foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['estacionamento'])) {

    // Recebendo os valores do formulário
    $estacionamento = (int)$_POST['estacionamento'];
    $modelo = $_POST['modelo'];
    $horario_inicio = $_POST['entrada'];
    $horario_final = $_POST['saida'];
    $placa = $_POST['placa'];
    $preferencial = (int)$_POST['preferencial']; // '1' para preferencial, '0' para comum
    $data = $_POST['data'];
    $validade = true;

    // Verificar se o horário está dentro do horário de funcionamento do estacionamento
    $sql_horario = "SELECT HorarioAbertura, HorarioFechamento FROM estacionamento WHERE ID = ?";
    $stmt = $conn->prepare($sql_horario);
    $stmt->bind_param("i", $estacionamento);
    $stmt->execute();
    $stmt->bind_result($horarioAbertura, $horarioFechamento);
    $stmt->fetch();
    $stmt->close();

    // Convertendo horários para objetos DateTime
    $entrada = new DateTime($horario_inicio);
    $saida = new DateTime($horario_final);
    $abertura = new DateTime($horarioAbertura);
    $fechamento = new DateTime($horarioFechamento);

    // Verifique se o horário de entrada e saída estão dentro do horário permitido
    if ($entrada < $abertura || $saida > $fechamento) {
        echo "<script>alert('Horário fora do funcionamento do estacionamento. Funcionamento: $horarioAbertura até $horarioFechamento.'); window.location.href='../index.php';</script>";
        exit();
    }

    // Verificar a disponibilidade de vagas
    if ($preferencial) {
        // Se o usuário escolheu vaga preferencial
        $sql_vagas = "SELECT COUNT(*) AS totalVagasPreferenciais FROM vaga WHERE Estacionamento = ? AND Preferencial = 1 AND Data = ?";
        $sql_limite = "SELECT LimitePreferencial FROM estacionamento WHERE ID = ?";
    } else {
        // Se o usuário escolheu vaga comum
        $sql_vagas = "SELECT COUNT(*) AS totalVagasComuns FROM vaga WHERE Estacionamento = ? AND Preferencial = 0 AND Data = ?";
        $sql_limite = "SELECT LimiteComum FROM estacionamento WHERE ID = ?";
    }

    // Consultar o número de vagas já reservadas
    $stmt_vagas = $conn->prepare($sql_vagas);
    $stmt_vagas->bind_param("is", $estacionamento, $data);
    $stmt_vagas->execute();
    $stmt_vagas->bind_result($totalVagas);
    $stmt_vagas->fetch();
    $stmt_vagas->close();

    // Consultar o limite de vagas disponíveis
    $stmt_limite = $conn->prepare($sql_limite);
    $stmt_limite->bind_param("i", $estacionamento);
    $stmt_limite->execute();
    $stmt_limite->bind_result($limiteVagas);
    $stmt_limite->fetch();
    $stmt_limite->close();

    // Verificar se o estacionamento está lotado
    if ($totalVagas >= $limiteVagas) {
        echo "<script>alert('Estacionamento lotado. Não é possível cadastrar mais vagas.'); window.location.href='../index.php';</script>";
        exit();
    }

    // Consultar o valor por hora do estacionamento
    $sql_valor = "SELECT ValorHora FROM estacionamento WHERE ID = ?";
    $stmt_valor = $conn->prepare($sql_valor);
    $stmt_valor->bind_param("i", $estacionamento);
    $stmt_valor->execute();
    $stmt_valor->bind_result($valorHora);
    $stmt_valor->fetch();
    $stmt_valor->close();

    // Chamar a função para calcular o valor total
    $valorTotal = calcularValorVaga($horario_inicio, $horario_final, $valorHora);

    // Query SQL para inserir os dados na tabela vaga
    $sql = "INSERT INTO vaga (ID, Estacionamento, Modelo, Horario_entrada, Horario_saida, Validade, Data, Placa, Valor, Preferencial) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparando o statement para evitar SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Liga os parâmetros no formato correto
        $stmt->bind_param("iissssssii", $idUsuario, $estacionamento, $modelo, $horario_inicio, $horario_final, $validade, $data, $placa, $valorTotal, $preferencial);

        // Executa a query
        if ($stmt->execute()) {
            echo "<script>alert('Vaga cadastrada com sucesso! A reserva ficou no valor de: R$ " . number_format($valorTotal, 2, ',', '.') . "'); window.location.href='../index.php';</script>";
            exit();
        } else {
            echo "Erro ao cadastrar vaga: " . $stmt->error;
        }

        // Fecha o statement
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}

function calcularValorVaga($horario_entrada, $horario_saida, $valorHora) {
    // Converter os horários de entrada e saída para objetos DateTime
    $entrada = new DateTime($horario_entrada);
    $saida = new DateTime($horario_saida);
    
    // Calcular a diferença entre entrada e saída
    $intervalo = $entrada->diff($saida);

    // Converter a diferença em horas (incluindo frações de horas)
    $horasTotais = $intervalo->h + ($intervalo->i / 60);

    // Se o período for maior que 24h, somar os dias em horas
    if ($intervalo->d > 0) {
        $horasTotais += $intervalo->d * 24;
    }

    // Calcular o valor total a ser pago
    $valorTotal = $horasTotais * $valorHora;

    // Retornar o valor total
    return $valorTotal;
}

?>
