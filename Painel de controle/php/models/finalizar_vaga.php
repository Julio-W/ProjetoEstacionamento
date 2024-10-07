<?php
session_start();
include("../config/database.php");

// Verificar se o usuário está logado e se o formulário foi enviado
if (isset($_SESSION['usuario_id']) && isset($_POST['vaga_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $vaga_id = $_POST['vaga_id']; // Este será o Cod da vaga

    // Atualizar o campo 'Validade' para falso (0) na tabela 'vaga' onde o Cod for igual ao fornecido
    $query_update = "UPDATE vaga SET Validade = 0 WHERE Cod = ? AND Estacionamento IN (SELECT ID FROM estacionamento WHERE Gerente = ?)";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bind_param("ii", $vaga_id, $usuario_id);
    
    if ($stmt_update->execute()) {
        // Redirecionar de volta à página anterior ou exibir uma mensagem de sucesso
        header("Location: ../../index.php");
    } else {
        echo "Erro ao finalizar a vaga.";
    }

    // Fechar a declaração e conexão
    $stmt_update->close();
    $conn->close();
} else {
    echo "Ação inválida.";
}
?>
