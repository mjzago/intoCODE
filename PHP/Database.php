<?php

$host = "localhost";
$username = "admin";
$password = "Mjones00";
$database = "user_repository";

// Número de registros por página
$registrosPorPagina = 5;

// Verificar se foi fornecido um número de página válido
if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

// Calcular o deslocamento (offset) para a consulta SQL
$offset = ($pagina - 1) * $registrosPorPagina;

// Criar conexão
$conn = new mysqli($host, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

// Consulta SQL com LIMIT e OFFSET para aplicar a paginação
$consulta = "SELECT SURENAME, FORENAME FROM users LIMIT $registrosPorPagina OFFSET $offset"; // Correção: Nome da tabela é "users"
$resultado = $conn->query($consulta);

echo "<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>";

echo "<table>";
echo "<tr><th>Name</th><th>Last Name</th></tr>";

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $surename = $row['SURENAME'];
        $forename = $row['FORENAME'];

        echo "<tr>";
        echo "<td>" . $forename . "</td>";
        echo "<td>" . $surename . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='2'>Nenhum resultado encontrado.</td></tr>";
}

echo "</table>";

// Consulta SQL para contar o número total de registros
$totalRegistrosConsulta = "SELECT COUNT(*) AS total FROM users";
$resultadoTotal = $conn->query($totalRegistrosConsulta);
$rowTotal = $resultadoTotal->fetch_assoc();
$totalRegistros = $rowTotal['total'];

// Calcular o número total de páginas
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Exibir links de paginação
echo "<div style='margin-top: 20px;'>";
echo "<strong>Pages:</strong> ";
for ($i = 1; $i <= $totalPaginas; $i++) {
    echo "<a href='?pagina=" . $i . "'>" . $i . "</a> ";
}
echo "</div>";


$conn->close();


?>


