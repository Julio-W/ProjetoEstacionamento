<?php
// Iniciar sessão


// Verifica se o usuário está logado
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta para obter o código do estacionamento do gerente logado
    $query_estacionamento = "SELECT ID FROM estacionamento WHERE Gerente = ?";
    $stmt_estacionamento = $conn->prepare($query_estacionamento);
    $stmt_estacionamento->bind_param("i", $usuario_id);
    $stmt_estacionamento->execute();
    $result_estacionamento = $stmt_estacionamento->get_result();

    if ($result_estacionamento->num_rows > 0) {
        // Obter o código do estacionamento
        $row_estacionamento = $result_estacionamento->fetch_assoc();
        $estacionamento_ID = $row_estacionamento['ID'];

        // Consulta para obter os dados da tabela 'vaga' relacionados ao estacionamento, apenas onde Validade é verdadeiro
        $query_vaga = "SELECT Horario_Entrada, Horario_Saida, Placa, Data, Modelo, Preferencial, Valor, Cod FROM vaga WHERE Estacionamento = ? AND Validade = 1";
        $stmt_vaga = $conn->prepare($query_vaga);
        $stmt_vaga->bind_param("i", $estacionamento_ID);
        $stmt_vaga->execute();
        $result_vaga = $stmt_vaga->get_result();

        // Exibir a tabela HTML se houver resultados
        if ($result_vaga->num_rows > 0) {
            echo '<h2>Registro de Estacionamento</h2>';
            echo '<table border="1">';
            echo '<thead>
                    <tr>
                        <th>Horário Entrada</th>
                        <th>Horário Saída</th>
                        <th>Placa</th>
                        <th>Data</th>
                        <th>Modelo</th>
                        <th>Preferencial</th>
                        <th>Valor</th>
                        <th>Finalizar</th>
                    </tr>
                  </thead>';
            echo '<tbody>';
            // Exibir cada linha da tabela
            while ($row_vaga = $result_vaga->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row_vaga['Horario_Entrada'] . '</td>';
                echo '<td>' . $row_vaga['Horario_Saida'] . '</td>';
                echo '<td>' . $row_vaga['Placa'] . '</td>';
                echo '<td>' . $row_vaga['Data'] . '</td>';
                echo '<td>' . $row_vaga['Modelo'] . '</td>';
                echo '<td>' . ($row_vaga['Preferencial'] ? 'Sim' : 'Não') . '</td>';
                echo '<td>' . $row_vaga['Valor'] . '</td>';
                echo '<td>
                        <form method="POST" action="php/models/finalizar_vaga.php">
                            <input type="hidden" name="vaga_id" value="' . $row_vaga['Cod'] . '">
                            <button type="submit">Finalizar</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "Nenhum registro de vaga válido encontrado para este estacionamento.";
        }
    } else {
        echo "Nenhum estacionamento encontrado para o gerente logado.";
    }
    
    // Fechar as declarações
    $stmt_estacionamento->close();
    $stmt_vaga->close();
} else {
    echo "Usuário não logado.";
}

// Fechar a conexão
$conn->close();
?>
