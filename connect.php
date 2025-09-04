<?php
// Variáveis com os dados para a conexão
$servidor = "localhost";        // Geralmente é localhost
$usuario = "root";              // Usuário padrão do XAMPP
$senha = "";                    // Senha padrão do XAMPP é vazia
$banco = "teste_webline";       // O nome do banco de dados que criamos

// mysqli_connect() tenta estabelecer a conexão com o banco
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Checagem de conexão
// Se a conexão falhar, o script para (die) e mostra o erro.
if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>