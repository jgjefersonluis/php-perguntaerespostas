<?php
$perguntas = array(
    "Qual é o nome da empresa de Bill Gates?",
    "Qual é o nome do criador do facebook?",
    "Qual é o site de pesquisa mais popular entre os jovens?",
    "Quais são os icones da informatica no filme Os Piratas do Vale do Silicio",
    "O que é um periférico?",
    "O que é o Linux?",
    "Qual a ferramenta que usamos para fazer desenhos e que ja vem instalado no Windows?"
);
$respostas = array(
    "Microsoft",
    "Mark Zuckerberg",
    "Google",
    "Bill Gates e Steve Jobs",
    "Componentes do computador",
    "Um sistema operacional de codigo aberto",
    "Paint"
);

$pos = 0;
$msg = "";

if (isset($_POST["btNovaPergunta"])) {
    $pos = SortearPergunta(4);
}
if (isset($_POST["btResponder"])) {
    $pos = $_POST["pos"];
    $resposta = $respostas[$pos];
    if ($resposta == $_POST["resposta"]) {
        $msg = "<h1>Parabens!!!! Você acertou.</h1>";
    } else {
        $msg = "<h1>Que pena!!!! Você Errou. Tente novamente</h1>";
    }
} else {
    $pos = SortearPergunta(4);
}

function SortearPergunta($tl)
{
    return rand(0, $tl - 1);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Avaliação Sistemas Operacionais</title>
</head>

<body>
    <h1>Avaliação Sistemas Operacionais</h1>
    <h2>Resposda as perguntas</h2>
    <h2>Pergunta: <?php echo $perguntas[$pos]; ?></h2>
    <form method="post" action="#">
        <input type="text" name="resposta" />
        <input type="hidden" name="pos" value="<?php echo $pos; ?>">
        <input type="submit" name="btResponder" value="Responder" />
    </form>
    <p></p>
    <form method="post" action="#">
        <input type="submit" name="btNovapergunta" value="Nova pergunta" />
    </form>
    <?php echo $msg; ?>
</body>

</html>