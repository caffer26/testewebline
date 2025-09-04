<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $placa = $_POST['placa'];
    $chassi = $_POST['chassi'];
    $montadora = $_POST['montadora'];

    $sql = "INSERT INTO automoveis (nome, placa, chassi, montadora) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sssi", $nome, $placa, $chassi, $montadora);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: listaautomoveis.php");
        exit();
    } else {
        echo "Erro ao cadastrar o automóvel. Por favor, tente novamente.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conexao);

?>