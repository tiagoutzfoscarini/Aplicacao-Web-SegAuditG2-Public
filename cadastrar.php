<html lang="br">
<head>
    <title>Cadastrar novo currículo</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body>
<h2>Página de Cadastro</h2>
<a class='button' href="index.php">Voltar ao início</a> <br/><br/>
<form action="cadastrar.php" method="POST">
    <label class="label">Nome*:<br/><input type="text" name="nome" size="50" pattern="[A-Za-zÀ-ÖØ-öø-ÿ ]+" required="required" placeholder="Xxxxx Xxxxx xx Xxxxx"/> <br/></label>
    <label class="label">Telefone:<br/><input type="tel" name="telefone" size="12" pattern="[0-9]{2} [0-9]{9}" placeholder="xx xxxxxxxxx"/> <br/></label>
    <label class="label">Email*:<br/><input type="email" name="email" size="60" placeholder="xxxxx@xxxxx.xxx" required="required" /> <br/></label>
    <label class="label">Website:<br/><input type="url" name="website" size="60" pattern="https?://.+" placeholder="www.website.com"/> <br/></label>
    <label class="label">Experiência Profissional*:<br/><textarea name="experiencia" maxlength="300" rows="6" cols="60" required="required"
                                        placeholder="Descrição de experiência profissional, máximo 300 caracteres e/ou 6 linhas"></textarea> <br/></label>
<!--        <h3>Experiência*:</h3> <input type="text" name="experiencia" size="300" required="required" /> <br/>-->
    <p>* Campos obrigatórios</p>
    <input class='button' type="submit" value="Cadastrar"/>
</form>

<?php
// Submit do formulário
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $config = include('config.php');

    // Conectar ao servidor e banco
//    $mysql = @mysqli_connect("localhost:3307", "php", "", "segauditg2") or die("&#9888; Falha: Sem conexão com o banco de dados. &#9888;");
    $mysql = @mysqli_connect("mysql-segauditg2.mysql.database.azure.com", "php@mysql-segauditg2", $config['db_password'],"segauditg2") or die("&#9888; Falha: Sem conexão com o banco de dados. &#9888;");

    // Extrair informações do formulário
    $nome = mysqli_real_escape_string($mysql, $_POST['nome']);
    $telefone = mysqli_real_escape_string($mysql, $_POST['telefone']);
    $email = mysqli_real_escape_string($mysql, $_POST['email']);
    $website = mysqli_real_escape_string($mysql, $_POST['website']);
    $experiencia = $_POST['experiencia'];  // Usado com o campo textarea
//    $experiencia = mysqli_real_escape_string($mysql, $_POST['experiencia']);  // Usado com o campo text
//    $experiencia = mysqli_real_escape_string($mysql, $_POST['experiencia']);  // Usado com o campo textarea

    // Retirar repetição de newlines
    $experiencia = preg_replace('/(\r\n|\r|\n)+/', "\n", $experiencia);
    // Quebra na sexta occorência de newline e concatena as primeiras 6 partes do array gerado
    $experiencia = explode("\n", $experiencia);
    $experiencia = implode("\n", array_slice($experiencia, 0, 6));
    $experiencia = mysqli_real_escape_string($mysql, $experiencia);

    // Inserção do novo cadastro no banco
    $query = "INSERT INTO Cadastro (nome, telefone, email, website, experiencia) 
              VALUES ('$nome', '$telefone', '$email', '$website', '$experiencia');";

    if (mysqli_query($mysql, $query)) {
        echo "<b>Currículo cadastrado com sucesso!</b>";
    } else {
        echo "<b>Erro: Falha ao inserir cadastro!</b>";
    }
    mysqli_close($mysql);
}
?>
</body>
<footer>
    <p>&copy; Faccat - Segurança e Auditoria de Sistemas 2022/01</p>
</footer>
</html>