<?php

include('header.php');

$op = $_POST['op'];

if ($op == 'adm') {
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        alterar($id, 'admin', 'nome', $nome, $conexao);
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        alterar($id, 'admin', 'email', $email, $conexao);
    }

    if (isset($_POST['senha'])) {
        $senha = md5($_POST['senha']);
        alterar($id, 'admin', 'senha', $senha, $conexao);
    }
    echo '<script>alert("Suas alterações foram salvas!");window.history.back();</script>';
}

if ($op == 'adm-edt') {
    $id_user = $_POST['id'];
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        alterar($id_user, 'admin', 'nome', $nome, $conexao);
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        alterar($id_user, 'admin', 'email', $email, $conexao);
    }

    echo '<script>alert("'.$_POST['nome'].' alterado com sucesso...");window.history.back();</script>';
}
