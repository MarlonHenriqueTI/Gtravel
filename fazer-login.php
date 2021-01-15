<?php

session_start();

include('db/functions.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

fazerLogin($usuario, $senha, $conexao);