<?php

include('db/functions.php');

$id = $_POST['id'];
$op = $_POST['op'];

if ($op == 'admin') {
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
    $novo_nome = md5(time()) . $extensao; //define o nome do arquivo
    $diretorio = "assets/fotos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

    alterar($id, 'admin', 'foto', $diretorio . $novo_nome, $conexao);

    echo "<script>window.history.back();</script>";
}
