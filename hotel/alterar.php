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

    echo '<script>alert("' . $_POST['nome'] . ' alterado com sucesso...");window.history.back();</script>';
}

if ($op = 'hsystem') {
    $id_hotel = $_POST['id'];
    $hotelId = $_POST['hotelId'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `hsystem` WHERE `id_hotel` = '$id_hotel'";
    $resultado = mysqli_query($conexao, $query);
    foreach ($resultado as $key) {
        $res[] = $key;
    }
    if (count($res == 0)) {
        cadastrarHsystem($conexao, $id_hotel, $hotelId, $userName, $password);
    } else {
        if (isset($_POST['hotelId'])) {
            $hotelId = $_POST['hotelId'];
            alterar($id_hotel, 'hsystem', 'hotelId', $hotelId, $conexao);
        }

        if (isset($_POST['userName'])) {
            $userName = $_POST['userName'];
            alterar($id_hotel, 'hsystem', 'userName', $userName, $conexao);
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            alterar($id_hotel, 'hsystem', 'password', $password, $conexao);
        }

        echo '<script>alert("Alterado com sucesso...");window.history.back();</script>';
    }
}
