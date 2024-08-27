<?php 
header('Location: ../../Painel de Controle/index.html');
//redirecionamento automático da página
include "..\config\database.php";
//linka o site com o banco de dados

// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos esperados estão definidos e não vazios
    if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["sexo"]) && isset($_POST["curso"])) {
        // Processa os dados conforme necessário
        $nome = ($_POST["nome"]);
        $email = ($_POST["email"]);
        $sexo = ($_POST["sexo"] == "M") ? "Masculino" : "Feminino";
        $curso = ($_POST["curso"]);      
    $sql = "INSERT INTO funcionario(nome, email, sexo, curso) VALUES ('$nome', '$email', '$sexo', '$curso')";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>
        alert('Cadastro realizado com sucesso');
        window.location.href = 'index.php';
    </script>";
        exit; 
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;}
    $conexao->close();
}}

exit();
?>