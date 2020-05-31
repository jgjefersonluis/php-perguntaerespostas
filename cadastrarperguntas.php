<?php

//conexão com o banco
//conectar no bancc de dados
$msg = "";
$banco = new mysqli("localhost", "root", "", "avalso");

if ($banco->connect_errno != 0) {
    //!=0 representa o codigo do erro
    echo "<h1>Erro de conexão</h1> <h2>Erro: " . $banco->connect_errno . "</h2>";
} else {
    //0 indica que conseguiu conectar no banco
    //echo "<h1> Conectou no banco de dados</h1>";
}
//cadastra as perguntas
if (isset($_POST["btCadastrar"])) {
    //dados para cadastrar
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];

    $sql = "insert into perguntas(pergunta,resposta)values('$pergunta','$resposta');";
    //echo $sql;
    //$sql = "INSERT INTO perguntas VALUES (null, '$pergunta', '$resposta')";
    if (mysqli_query($banco, $sql)) {
        $msg = "<h2>Cadastro efetuado corretamente</h2>";
    } else {
        $msg = "<h2>Erro ao efetuar o cadastro</h2>";
    }
}

//exclui pergunta
if (isset($_GET["id"])) {
    //dados para cadastrar
    $id = $_GET["id"];
    $sql = "delete from perguntas where id = $id";
    //echo $sql;
    mysqli_query($banco, $sql);
}


?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Avaliação Sistemas Operacionais</title>
    <link href="css/folha.css" rel="stylesheet">
</head>

<body>
    <h1>Avaliação Sistemas Operacionais - Cadastro de Perguntas.</h1>

    <form method="post" action="#">



        <input type="text" name="pergunta" placeholder="Informe o texto da pergunta" />
        <input type="text" name="resposta" placeholder="Informe a resposta da pergunta">
        <input type="submit" id="bk" name="btCadastrar" value="Cadastrar" />
    </form>
    <h2>Lista de perguntas</h2>

    <form method="post" action="#">
        <input type="text" name="texto" placeholder="Informe o texto da pergunta">
        <input type="submit" id="bk" name="btLocalizar" value="Localizar">
        <br>
    </form>

    <?php
    echo $msg;
    //Lista todas as perguntas
    $sql = "select * from perguntas";
    if (isset($_POST["btLocalizar"])) {
        $valor = $_POST["texto"];
        $sql = "select * from perguntas where pergunta like '%$valor%'";
    }
    $perguntas = mysqli_query($banco, $sql);
    echo '<table border="1">';
    echo "<tr><td>Id</td><td>Pergunta</td><td>Resposta</td><td>Opções</td></tr>";
    while ($pergunta = mysqli_fetch_array($perguntas)) {
        echo "<tr><td>" . $pergunta["id"] . "</td><td>" . $pergunta["pergunta"] . "</td><td>" . $pergunta["resposta"] . '</td><td><a href="cadastrarperguntas.php?id=' . $pergunta["id"] . '">Excluir</a></td></tr>';
    }
    echo "</table>";

    ?>

</body>

</html>