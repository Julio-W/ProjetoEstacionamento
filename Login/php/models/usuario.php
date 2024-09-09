<?php 
//header('Location: ../../Painel de Controle/index.html');
//redirecionamento automático da página
include "..\config\database.php";
//linka o site com o banco de dados

// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos esperados estão definidos e não vazios
    if (isset($_POST["pass"]) && isset($_POST["email"]) ) {
 

        $Email = $_POST["email"];

        $Senha = $_POST["pass"];
      
        $sql="INSERT INTO usuario(Email,Senha) VALUES
        ('$Email','$Senha')  ";
      
        if ($conexao->query($sql) === TRUE) {
          
         
     
          exit; 
      } else {
          echo "Erro: " . $sql . "<br>" . $conexao->error;}
      
      $conexao->close();
      
      
     }}
//exit();
?>