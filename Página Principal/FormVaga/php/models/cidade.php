<?php 
// Inclui o arquivo de configuração do banco de dados
include "../config/database.php"; // Corrigi o caminho do include

// Verifica se o estado foi passado como parâmetro
if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];

    // Consulta o banco de dados usando DISTINCT para evitar duplicações
    $sql = "SELECT DISTINCT cidade FROM estacionamento WHERE estado = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $estado);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cria as opções do select
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . htmlspecialchars($row['cidade']) . "'>" . htmlspecialchars($row['cidade']) . "</option>";
    }

    echo $options;

    $stmt->close();
} else {
    echo "<option value=''>Nenhum estado selecionado</option>";
}

$conn->close();
?>
