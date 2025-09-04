<?php
// 1. CONEXÃO COM O BANCO DE DADOS
require_once 'connect.php';

// 2. LÓGICA DA BUSCA
// A variável $busca vai guardar o termo pesquisado pelo usuário.
// Usamos o operador ternário para verificar se $_GET['busca'] existe.
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// 3. MONTANDO A QUERY SQL PRINCIPAL
// Esta é a parte mais importante. Usamos o JOIN para combinar as tabelas.
// 'a' é um apelido para 'automoveis' e 'm' é um apelido para 'montadoras'.
$sql = "SELECT a.codigo, a.nome, a.placa, a.chassi, m.nome AS nome_montadora
        FROM automoveis AS a
        JOIN montadoras AS m ON a.montadora = m.codigo";

// 4. ADICIONANDO O FILTRO DE BUSCA SE NECESSÁRIO
if ($busca != '') {
    // Se o usuário pesquisou algo, adicionamos o WHERE na nossa query
    // O LIKE com '%' permite buscar por partes do nome.
    $sql .= " WHERE a.nome LIKE ?";
}

// 5. PREPARANDO E EXECUTANDO A QUERY
$stmt = mysqli_prepare($conexao, $sql);

if ($busca != '') {
    // Se houve busca, precisamos associar o parâmetro
    $termo_busca = "%" . $busca . "%";
    mysqli_stmt_bind_param($stmt, "s", $termo_busca);
}

mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Lista de Automóveis</title>
</head>
<body>
    <div class="container mt-4">
        <h2>Lista de Automóveis Cadastrados</h2>
        <hr>

        <a href="index.php" class="btn btn-success mb-3">Cadastrar Novo Automóvel</a>

        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por nome..." value="<?php echo htmlspecialchars($busca); ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Placa</th>
                    <th>Chassi</th>
                    <th>Montadora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($resultado) > 0) {
                    while ($carro = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $carro['codigo'] . "</td>";
                        echo "<td>" . htmlspecialchars($carro['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($carro['placa']) . "</td>";
                        echo "<td>" . htmlspecialchars($carro['chassi']) . "</td>";
                        echo "<td>" . htmlspecialchars($carro['nome_montadora']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhum automóvel encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
// Fechando a conexão
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>