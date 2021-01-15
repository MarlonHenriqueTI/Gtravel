<?php

include('header.php');

$op = $_POST['op'];

if ($op == 'adm') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $senha = $_POST['senha'];
    cadastrarAdmin($conexao, $nome, $username, $senha, $email);
}
