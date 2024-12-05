<?php
include 'config.php';


header('Content-Type: application/json');

// Recebe os dados JSON via POST
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados foram recebidos corretamente
if (isset($data['titulo']) && isset($data['ingredientes']) && isset($data['modo_preparo'])) {
    $titulo = $data['titulo'];
    $ingredientes = $data['ingredientes'];
    $modo_preparo = $data['modo_preparo'];

    // Inserir no banco de dados 
    $sql = "INSERT INTO receitas (titulo, ingredientes, modo_preparo) VALUES ('$titulo', '$ingredientes', '$modo_preparo')";

    if ($conn->query($sql) === TRUE) {
     
        echo json_encode(['success' => true, 'message' => 'Receita adicionada com sucesso!']);
    } else {
        
        echo json_encode(['success' => false, 'message' => 'Erro ao adicionar receita: ' . $conn->error]);
    }
} else {
    
    echo json_encode(['success' => false, 'message' => 'Dados inválidos!']);
}

$conn->close();
?>
