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

if($op == 'hotel') {
    $nome_responsavel = $_POST['nome_responsavel'];
    $razao_social = $_POST['razao_social'];
    $nome_hotel = $_POST['nome_hotel'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['uf'];
    $pais = $_POST['pais'];
    $complemento = $_POST['complemento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $username = $_POST['username'];
    cadastrarHotel($conexao, $nome_responsavel, $cpf_cnpj, $razao_social, $rua, $numero, $bairro, $cidade, $estado, $pais, $cep, $complemento, $email, $senha, $username, $nome_hotel );
}