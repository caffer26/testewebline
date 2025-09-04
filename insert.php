<?php
// Inclui o arquivo de conexão
require_once 'connect.php';

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $placa = $_POST['placa'];
    $chassi = $_POST['chassi'];
    $montadora = $_POST['montadora'];

    // Prepara a query SQL para evitar SQL Injection
    $sql = "INSERT INTO automoveis (nome, placa, chassi, montadora) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    // Associa os parâmetros com os tipos corretos (3 strings, 1 inteiro)
    mysqli_stmt_bind_param($stmt, "sssi", $nome, $placa, $chassi, $montadora);

    // Executa a query
    if (mysqli_stmt_execute($stmt)) {
        // Se deu certo, redireciona para a página de listagem
        header("Location: listaautomoveis.php");
        exit();
    } else {
        // Se deu errado, mostra um erro claro
        echo "Erro ao cadastrar o automóvel. Por favor, tente novamente.";
        // Linha para debug (opcional): echo "Erro: " . mysqli_stmt_error($stmt);
    }

    // Fecha a statement
    mysqli_stmt_close($stmt);
}

// Fecha a conexão
mysqli_close($conexao);

?>