<?php 
// Inclui o arquivo de configuração do banco de dados
include "../config/database.php"; // Corrija o caminho conforme necessário

// Verifica se a cidade foi passada como parâmetro
if (isset($_GET['cidade'])) {
    $cidade = $_GET['cidade'];

    // Consulta o banco de dados para buscar os estacionamentos na cidade selecionada
  // Atualize a query SQL para incluir o ID do estacionamento
$sql = "SELECT ID, Nome FROM estacionamento WHERE cidade = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cidade);
$stmt->execute();
$result = $stmt->get_result();

// Cria as opções do select
$options = "";
while ($row = $result->fetch_assoc()) {
    // Use o ID como valor e o Nome como texto visível no select
    $options .= "<option value='" . htmlspecialchars($row['ID']) . "'>" . htmlspecialchars($row['Nome']) . "</option>";
}


    echo $options;

    $stmt->close();
} else {
    echo "<option value=''>Nenhuma cidade selecionada</option>";
}

$conn->close();
?>
