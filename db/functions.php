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


/*funções de cadastro */
function cadastrarAdmin($conexao, $nome, $username, $senha, $email)
{
    $senhacrip = md5($senha);
    $query = "INSERT INTO `admin` (`username`, `email`, `senha`, `nome`) VALUES ('$username', '$email', '$senhacrip', '$nome')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um administrador no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . var_dump($resultado) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um administrador', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar administrador, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde...");window.location.href="cadastrar-adm.php";</script>';
    } else {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Cadastro realizado" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Seu cadastro foi realizado na plataforma GTravel, seguem os dados de acesso:\n"; //Aqui vai o telefone no e-mail
        $body = $body . "Link: https://gtravel.com.br\n";
        $body = $body . "Nome de usuário: " . $username . "\n";
        $body = $body . "Senha: " . $senha . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail($email, 'GTravel - Seu cadastro foi realizado!', $body, "From: GTravel!\r\n");
        echo "<script>alert('Cadastrado com sucesso!');window.location.href='administradores.php';</script>";
    }
}


/*funções de seleção*/
function selecionarAdmin($conexao, $id)
{
    $query = "SELECT * FROM `admin` WHERE `id` = '$id'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Administrador não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarTodosAdmin($conexao)
{
    $query = "SELECT * FROM `admin`";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Administrador não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}
