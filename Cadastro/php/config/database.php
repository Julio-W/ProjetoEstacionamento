<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartparker";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão teste
if ($conn->connect_error)   
 {
    die("Connection failed: " . $conn->connect_error);   

}
?>