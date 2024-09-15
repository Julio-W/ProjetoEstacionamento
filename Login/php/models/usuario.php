<?php 
//header('Location: ../../Painel de Controle/index.html');
//redirecionamento automático da página
include "..\config\database.php";
//linka o site com o banco de dados


        $email = $_POST["email"];

        $senha = $_POST["pass"];

        // Verifica se o e-mail existe no banco de dados
        $sql = "SELECT senha FROM usuario WHERE email = '$email'";
        $result = $conn->query($sql);  // Executa a consulta
      
        if ($result->num_rows > 0) {
        // O e-mail foi encontrado no banco de dados
        $row = $result->fetch_assoc();
      
        // Compara a senha fornecida com a senha do banco de dados
        if ($senha == $row['senha']) {
            header("Location: ../../../Página Principal/index.html");
            exit();

            } 

            else {

               

                $dados = ['mensagem' => 'A senha está incorreta', 'email' => "$email", 'teste' => true];
                echo '<script>var dadosPHP = ' . json_encode($dados) . ';</script>';
                header("Location: ../../index.html");
                exit();
                //mantém o email no formulário, deve levar ele como value
                //levar informação de reiniciação e se ela existir vai executar o alert

            }
              } else {  $dados = ['mensagem' => 'Esse email não está cadastrado', 'email' => "", 'teste' => true];
                echo '<script>var dadosPHP = ' . json_encode($dados) . ';</script>';
                header("Location: ../../index.html");
                exit();
              }
          
          
      
      
      // Fecha a conexão com o banco de dados
      $conn->close();
?>