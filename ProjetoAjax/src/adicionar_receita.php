<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Receita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

   
    <div class="navbar">
        <a href="index.php">Início</a>
        <a href="adicionar_receita.php">Adicionar Receita</a> 
    </div>

  
    <div class="container mt-5">
        <h1>Adicionar Nova Receita</h1>
        
        <form id="formAdicionarReceita">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="ingredientes" class="form-label">Ingredientes</label>
                <textarea class="form-control" id="ingredientes" name="ingredientes" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="modo_preparo" class="form-label">Modo de Preparo</label>
                <textarea class="form-control" id="modo_preparo" name="modo_preparo" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Receita</button>
        </form>

        <div id="message" class="mt-3"></div>
    </div>

    <script>
        document.getElementById('formAdicionarReceita').addEventListener('submit', async function (e) {
            e.preventDefault(); 

            //pegaos  valores do formulário
            const titulo = document.getElementById('titulo').value;
            const ingredientes = document.getElementById('ingredientes').value;
            const modo_preparo = document.getElementById('modo_preparo').value;

            
            const data = { titulo, ingredientes, modo_preparo };

            try {
              
                const response = await fetch('adicionar_receita_ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json(); 

                const messageDiv = document.getElementById('message');
                if (result.success) {
                    messageDiv.innerHTML = `<div class="alert alert-success">${result.message}</div>`;
                    document.getElementById('formAdicionarReceita').reset(); 
                } else {
                    messageDiv.innerHTML = `<div class="alert alert-danger">${result.message}</div>`;
                }

            } catch (error) {
                console.error('Erro ao enviar os dados:', error);
                document.getElementById('message').innerHTML = `<div class="alert alert-danger">Erro ao adicionar a receita!</div>`;
            }
        });
    </script>
</body>
</html>
