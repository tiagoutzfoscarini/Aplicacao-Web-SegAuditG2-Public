<html lang="br">
<head>
    <title>Consultar currículo</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body>
<h2>Consulta currículo</h2>
<a class='button' href="listar.php">Voltar</a> <br/><br/>

<?php
$config = include('config.php');
// Código não usado
//session_start();
//$consultarId = $_SESSION['consultarId'];
//echo $consultarId;

// Conectar ao servidor e banco
//$mysql = @mysqli_connect("localhost:3307", "php", "", "segauditg2") or die("&#9888; Falha: Sem conexão com o banco de dados. &#9888;");
$mysql = @mysqli_connect("mysql-segauditg2.mysql.database.azure.com", "php@mysql-segauditg2", $config['db_password'],"segauditg2") or die("&#9888; Falha: Sem conexão com o banco de dados. &#9888;");

// Validação que o ID é um número, se não for, apresenta um aviso
$id = (int)mysqli_real_escape_string($mysql, $_GET['id']);
if (!is_integer($id) or $id <= 0) {
    echo "<script>alert('INVALID ID');</script>";
    $id = 0;
}

// Consulta no banco
$query = "SELECT * FROM Cadastro WHERE id = {$id};";
$result = mysqli_query($mysql, $query);  // Quer

// Encerra a conexão com o banco
mysqli_close($mysql);

// Apresenta a tabela com informações completas do currículo consultado
//echo "<table><tr><th>Id</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Website</th><th>Experiência Profissional</th></tr>";
echo "<table><tr><th>Nome</th><th>Telefone</th><th>Email</th><th>Website</th><th>Experiência Profissional</th></tr>";

while($row = mysqli_fetch_assoc($result))
{
    echo "<tr>";
//    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['telefone'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['website'] . "</td>";
    echo "<td>" . $row['experiencia'] . "</td>";
    echo "</tr>";
}

echo "</table>";

?>
</body>
<footer>
    <p>&copy; Faccat - Segurança e Auditoria de Sistemas 2022/01</p>
</footer>
</html>