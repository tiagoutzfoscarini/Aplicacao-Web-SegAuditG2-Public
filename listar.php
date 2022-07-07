<html lang="br">
<head>
    <title>Listagem de currículos</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body>
<h2>Currículos cadastrados</h2>
<a class='button' href="index.php">Voltar ao início</a> <br/><br/>

<?php
$config = include('config.php');
// Conectar ao servidor e banco
//$mysql = @mysqli_connect("localhost:3307", "php", "", "segauditg2") or die("&#9888; Falha: Sem conexão com o banco de dados. &#9888;");
$mysql = @mysqli_connect("mysql-segauditg2.mysql.database.azure.com", "php@mysql-segauditg2", $config['db_password'],"segauditg2") or die("&#9888; Falha: Sem conexão com o banco de dados. &#9888;");

// Consulta no baco
$query = "SELECT * FROM Cadastro;";
$result = mysqli_query($mysql, $query);

echo "{$result->num_rows} cadastro(s) encontrado(s):";

// Encerra a conexão com o banco
mysqli_close($mysql);

// Código não usado
//session_start();
//$_SESSION['consultarId'] = 0;

// Apresenta a tabela com os currículos cadastrados (nome e email)
//echo "<table><tr><th>ID</th><th>NOME</th><th>EMAIL</th></tr>";
echo "<table><tr><th>Nome</th><th>Email</th></tr>";

while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
//    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . "<a class='button' href='consultar.php?id={$row['id']}'>Consultar</a>" . "</td>";
    echo "</tr>";
}

echo "</table>";

?>
</body>
<footer>
    <p>&copy; Faccat - Segurança e Auditoria de Sistemas 2022/01</p>
</footer>
</html>