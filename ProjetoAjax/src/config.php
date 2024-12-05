<?php
$servername = "localhost";
$username = "root";  //  usuário 
$password = "";      // senha
$dbname = "receitas";

//conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão com banco
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
