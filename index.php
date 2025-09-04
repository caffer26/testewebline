<?php
// 1. CONEXÃO COM O BANCO DE DADOS
// O comando require_once inclui o arquivo de conexão.
// Se o arquivo não for encontrado, o script para.
require_once 'connect.php';

// 2. BUSCANDO AS MONTADORAS NO BANCO
// Criamos a consulta SQL para buscar todas as montadoras em ordem alfabética.
$sql = "SELECT codigo, nome FROM montadoras ORDER BY nome";
// mysqli_query() executa a consulta no banco de dados.
// O resultado é armazenado na variável $resultado_montadoras.
$resultado_montadoras = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Automóveis</title>
</head>
<body>
    <div class="container mt-4">
        <h2>Cadastrar Novo Automóvel</h2>
        <hr>

        <form action="insert.php" method="POST">
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Carro:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="placa" class="form-label">Placa:</label>
                <input type="text" class="form-control" id="placa" name="placa" required>
            </div>
            
            <div class="mb-3">
                <label for="chassi" class="form-label">Chassi:</label>
                <input type="text" class="form-control" id="chassi" name="chassi" required>
            </div>

            <div class="mb-3">
                <label for="montadora" class="form-label">Montadora:</label>
                <select class="form-select" id="montadora" name="montadora" required>
                    <option value="">-- Selecione uma montadora --</option>
                    <?php
                        while ($montadora = mysqli_fetch_assoc($resultado_montadoras)) {
                            echo "<option value='{$montadora['codigo']}'>{$montadora['nome']}</option>";
                        }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar Automóvel</button>
        </form>
    </div>
</body>
</html>