<?php

include('db.php');

/*funções de exclusão*/
function deletar($id, $tabela, $conexao)
{
    $query = "DELETE FROM `$tabela` WHERE `$tabela`.`id` = $id";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo "<script>alert('Erro ao deletar...');</script>";
        die();
    } else {
        echo "<script>alert('Deletado com sucesso...');window.location.href='javascript:history.back()';</script>";
    }
}

if (isset($_GET["id"]) && isset($_GET["tabela"]) && isset($_GET["deletar"])) {
    deletar($_GET["id"], $_GET["tabela"], $conexao);
}

/*funções para Alterar*/
function alterar($id, $tabela, $campo, $valor, $conexao)
{
    $query = "UPDATE `$tabela` SET `$campo` = '$valor' WHERE `$tabela`.`id` = $id";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo "<script>alert('Erro ao alterar...');</script>";
        die();
    }
}


if (isset($_GET["id"]) && isset($_GET["tabela"]) && isset($_GET["alterar"]) && isset($_GET["campo"]) && isset($_GET["valor"])) {
    alterar($_GET["id"], $_GET["tabela"], $_GET["campo"], $_GET["valor"], $conexao);
}

/*função Login*/

function fazerLogin($usuario, $senha, $conexao)
{
    $senha = md5($senha);

    $login = "SELECT * ";
    $login .= "FROM admin ";
    $login .= "WHERE username = '{$usuario}' and senha = '{$senha}'";
    $acesso = mysqli_query($conexao, $login);

    if (!$acesso) {
        die("Falha na consulta ao banco");
    }
    $informacao = mysqli_fetch_assoc($acesso);
    if (empty($informacao)) {
        $login = "SELECT * ";
        $login .= "FROM camareira ";
        $login .= "WHERE username = '{$usuario}' and senha = '{$senha}'";
        $acesso = mysqli_query($conexao, $login);

        if (!$acesso) {
            die("Falha na consulta ao banco");
        }

        if (empty($informacao)) {
            $login = "SELECT * ";
            $login .= "FROM hotel ";
            $login .= "WHERE username = '{$usuario}' and senha = '{$senha}'";
            $acesso = mysqli_query($conexao, $login);

            if (!$acesso) {
                die("Falha na consulta ao banco");
            }

            if (empty($informacao)) {
                echo "<script language='javascript' type='text/javascript'>alert('Opssss... tem algo errado, confira seu login e senha por favor e tente novamente...');window.location.href='javascript:history.back()';</script>";
            } else {
                $_SESSION["user_portal"] = $informacao["email"];
                header("Location: hotel/index.php");
            }
        } else {
            $_SESSION["user_portal"] = $informacao["email"];
            header("Location: governanca/index.php");
        }
    } else {
        $_SESSION["user_portal"] = $informacao["email"];
        header("Location: admin/index.php");
    }
}
