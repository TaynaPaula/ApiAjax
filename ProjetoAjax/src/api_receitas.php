<?php
include 'config.php';

// Definir o cabeçalho para retornar JSON
header('Content-Type: application/json');

// Consultar as receitas
$sql = "SELECT * FROM receitas";
$result = $conn->query($sql);

$receitas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $receitas[] = [
            'titulo' => $row['titulo'],
            'ingredientes' => $row['ingredientes'],
            'modo_preparo' => $row['modo_preparo']
        ];
    }
} else {
    $receitas = [];
}

$conn->close();

//retorno das receitas 
echo json_encode($receitas);
?>
