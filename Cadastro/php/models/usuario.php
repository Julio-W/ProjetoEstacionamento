<?php 

//redirecionamento automático da página
include "..\config\database.php";
//linka o site com o banco de dados

// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos esperados estão definidos e não vazios
    if (isset($_POST["pass"]) && isset($_POST["email"]) ) {
 

    
$email = $_POST['email'];
$senha = $_POST['senha']; 

// Verifica se o e-mail já existe no banco de dados
$sql = "SELECT COUNT(*) FROM usuarios WHERE email = $email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$email_existe = $stmt->fetchColumn();

if ($email_existe > 0) {
    // Se o e-mail já estiver cadastrado, redireciona para login.html com mensagem de erro
    header("Location: ../../../Login/index.html?erro=email_existente");
    exit();
} else {
    // Se o e-mail não estiver cadastrado, cria uma nova conta
    $sql = "INSERT INTO usuarios ( email, senha) VALUES ( $email, $senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha); // Armazenando a senha diretamente

    if ($stmt->execute()) {
        // Redireciona para a página padrão após o cadastro bem-sucedido
        header("Location:  ../../Painel de Controle/index.html");
        exit();
    } 
}
?>
?>
