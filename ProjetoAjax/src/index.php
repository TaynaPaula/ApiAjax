<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site de Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css"> 
<body>


    <div class="navbar">
        <a href="index.php">Início</a>
        <a href="adicionar_receita.php">Adicionar Receita</a> 


    <div class="container mt-5">
        <h1>Minhas Receitas</h1>

        
        <div id="carouselReceitas" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" id="carouselItems"></div>

            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselReceitas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselReceitas" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
      
        async function loadRecipes() {
            try {
                const response = await fetch('api_receitas.php'); // Requisição para a API Fetch
                const receitas = await response.json(); // Parse do JSON

                if (receitas.length > 0) {
                    const carouselItems = document.getElementById('carouselItems');
                    let activeClass = 'active'; 
                    receitas.forEach((receita, index) => {
                        const item = document.createElement('div');
                        
                        if (activeClass) {
                            item.classList.add('carousel-item', activeClass);
                            activeClass = ''; 
                        } else {
                            item.classList.add('carousel-item');
                        }

                        item.innerHTML = `
                            <div class="d-block w-100 p-4 bg-light rounded">
                                <h3>${receita.titulo}</h3>
                                <h4>Ingredientes:</h4><p>${receita.ingredientes}</p>
                                <h4>Modo de Preparo:</h4><p>${receita.modo_preparo}</p>
                            </div>
                        `;

                        carouselItems.appendChild(item);
                    });
                } else {
                    document.getElementById('carouselItems').innerHTML = '<p>Não há receitas cadastradas.</p>';
                }
            } catch (error) {
                console.error('Erro ao carregar receitas:', error);
            }
        }

        // Carregar as receitas com a inicialização da página
        window.onload = loadRecipes;
    </script>
</body>
</html>
