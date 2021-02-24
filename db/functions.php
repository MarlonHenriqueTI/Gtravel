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

function setDisponibilidade($id, $conexao, $disponibilidade)
{
    $query = "UPDATE `apartamento` SET `status` = '$disponibilidade' WHERE `id` = $id";
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
        $informacao = mysqli_fetch_assoc($acesso);
        if (empty($informacao)) {
            $login = "SELECT * ";
            $login .= "FROM hotel ";
            $login .= "WHERE username = '{$usuario}' and senha = '{$senha}'";
            $acesso = mysqli_query($conexao, $login);

            if (!$acesso) {
                die("Falha na consulta ao banco");
            }
            $informacao = mysqli_fetch_assoc($acesso);
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

function cadastrarHotel($conexao, $nome_responsavel, $cpf_cnpj, $razao_social, $rua, $numero, $bairro, $cidade, $estado, $pais, $cep, $complemento, $email, $senha, $username, $nome_hotel)
{
    $senhacrip = md5($senha);
    $query = "INSERT INTO `hotel`(`nome_responsavel`, `cpf_cnpj`, `razao_social`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `complemento`, `email`, `senha`, `username`, `nome_hotel`) VALUES ('$nome_responsavel', '$cpf_cnpj', '$razao_social', '$rua', '$numero', '$bairro', '$cidade', '$estado', '$pais', '$cep', '$complemento', '$email', '$senhacrip', '$username', '$nome_hotel')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um hotel no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . var_dump($resultado) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um administrador', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar hotel, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde...");window.location.href="cadastrar-adm.php";</script>';
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
        echo "<script>alert('Cadastrado com sucesso!');window.location.href='hoteis.php';</script>";
    }
}

function cadastrarHospede($conexao, $nome, $email, $telefone, $rua, $numero, $cep, $bairro, $estado, $cidade, $idade, $sexo, $complemento, $cpf, $id_hotel)
{
    $query = "INSERT INTO `hospede`(`nome`, `email`, `telefone`, `rua`, `numero`, `cep`, `bairro`, `estado`, `cidade`, `idade`, `sexo`, `complemento`, `cpf`, `id_hotel`) VALUES ('$nome', '$email', '$telefone', '$rua', '$numero', '$cep', '$bairro', '$estado', '$cidade', '$idade', '$sexo', '$complemento', '$cpf', '$id_hotel')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um hospede no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . var_dump($resultado) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um hospede', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar hospede, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde...");window.location.href="cadastrar-cliente.php";</script>';
    } else {
        echo "<script>alert('Cadastrado com sucesso!');window.location.href='hospedes.php';</script>";
    }
}

function cadastrarHospedeReserva($conexao, $nome, $email, $telefone, $cpf, $id_hotel)
{
    $query = "INSERT INTO `hospede`(`nome`, `email`, `telefone`, `cpf`, `id_hotel`) VALUES ('$nome', '$email', '$telefone', '$cpf', '$id_hotel')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um hospede no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . var_dump($resultado) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um hospede', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar hospede, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde...");';
    }
}

function cadastrarHospedeReservaHsystem($conexao, $nome, $email, $telefone, $cpf, $id_hotel, $id)
{
    $query = "INSERT INTO `hospede`(`nome`, `email`, `telefone`, `cpf`, `id_hotel`, `id`) VALUES ('$nome', '$email', '$telefone', '$cpf', '$id_hotel', '$id')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        printf("Errormessage: %s\n", mysqli_error($conexao));
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um hospede no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . mysqli_error($conexao) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um hospede da HSYSTEM', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar um hospede da Hsystem, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde... Descrição do erro:'.mysqli_error($conexao).'");</script>';
    }
}


function cadastrarQuarto($conexao, $nome, $tipo, $capacidade, $obs, $id_hotel, $id_tipo)
{
    $query = "INSERT INTO `apartamento`(`nome`, `tipo`, `capacidade`, `obs`, `id_hotel`, `id_tipo`) VALUES ('$nome', '$tipo', '$capacidade', '$obs', '$id_hotel', '$id_tipo')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um apartamento no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . var_dump($resultado) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um apartamento', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar quarto, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde...");window.location.href="cadastrar-quarto.php";</script>';
    } else {
        echo "<script>alert('Cadastrado com sucesso!');window.location.href='quartos.php';</script>";
    }
}

function cadastrarHsystem($conexao, $id_hotel, $hotelId, $userName, $password)
{
    $query = "INSERT INTO `hsystem`(`id_hotel`, `hotelId`, `userName`, `password`) VALUES ('$id_hotel', '$hotelId', '$userName', '$password')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar os dados da Hsystem no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . var_dump($resultado) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar os dados da Hsystem', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar os dados da Hsystem, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde...");window.location.href="perfil.php";</script>';
    } else {
        echo "<script>alert('Cadastrado com sucesso!');window.location.href='perfil.php';</script>";
    }
}

function cadastrarTaxa($conexao, $id_hotel, $nome, $valor, $descricao)
{
    $query = "INSERT INTO `taxa`(`id_hotel`, `nome`, `valor`, `descricao`) VALUES ('$id_hotel', '$nome', '$valor', '$descricao')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        printf("Errormessage: %s\n", mysqli_error($conexao));
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar uma taxa no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . mysqli_error($conexao) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar uma taxa', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar taxa, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde... Descrição do erro:'.mysqli_error($conexao).'");window.history.back();</script>';
    } else {
        echo "<script>alert('Cadastrado com sucesso!');window.history.back();</script>";
    }
}

function cadastrarTipoQuarto($conexao, $id_hotel, $nome, $descricao)
{
    $query = "INSERT INTO `tipo_quarto`(`id_hotel`, `nome`, `descricao`) VALUES ('$id_hotel', '$nome', '$descricao')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        printf("Errormessage: %s\n", mysqli_error($conexao));
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar um tipo de quarto no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . mysqli_error($conexao) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um tipo de quarto', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar tipo de quarto, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde... Descrição do erro:'.mysqli_error($conexao).'");window.history.back();</script>';
    } else {
        echo "<script>alert('Cadastrado com sucesso!');window.history.back();</script>";
    }
}

function cadastrarReserva($conexao, $cpf_cnpj, $rg, $nome, $telefone, $email, $cpf_cnpj_empresa, $nome_empresa, $pagamento, $checkin, $checkout, $id_quarto, $id_cliente, $id_hotel, $status, $hospedes, $pre_pagamento, $nao_reembolsavel, $valor_cobrado, $valor_diarias, $valor_extras, $valor_taxas, $valor_descontos, $valor_total)
{
    $query = "INSERT INTO `reserva`(`cpf_cnpj`, `rg`, `nome`, `telefone`, `email`, `cpf_cnpj_empresa`, `nome_empresa`, `pagamento`, `checkin`, `checkout`, `id_quarto`, `id_cliente`, `id_hotel`, `status`, `hospedes`, `pre_pagamento`, `nao_reembolsavel`, `valor_cobrado`, `valor_diarias`, `valor_extras`, `valor_taxas`, `valor_descontos`, `valor_total`) VALUES ('$cpf_cnpj', '$rg', '$nome', '$telefone', '$email', '$cpf_cnpj_empresa', '$nome_empresa', '$pagamento', '$checkin', '$checkout', '$id_quarto', '$id_cliente', '$id_hotel', '$status', '$hospedes', '$pre_pagamento', '$nao_reembolsavel', '$valor_cobrado', '$valor_diarias', '$valor_extras', '$valor_taxas', '$valor_descontos', '$valor_total')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        printf("Errormessage: %s\n", mysqli_error($conexao));
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar uma reserva no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . mysqli_error($conexao) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um reserva', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar reserva, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde... Descrição do erro:'.mysqli_error($conexao).'");window.location.href="nova-reserva.php";</script>';
    } else {
        echo "<script>alert('Cadastrado com sucesso!');window.location.href='reservas.php';</script>";
    }
}

function dateEmMysql($dateSql)
{
    $ano = substr($dateSql, 6);
    $mes = substr($dateSql, 3, -5);
    $dia = substr($dateSql, 0, -8);
    return $ano . "-" . $mes . "-" . $dia;
}

function cadastrarReservaHSystem($conexao, $id, $nome, $telefone, $email, $pagamento, $checkin, $checkout, $id_quarto, $id_cliente, $id_hotel, $status, $hospedes, $data, $valor_total, $valor_extras, $pre_pagamento)
{
    $id = intval($id);
    if ($pagamento == 1) {
        $pagamento = "Cartão de crédito";
    } else if ($pagamento == 2) {
        $pagamento = "Deposito";
    } else if ($pagamento == 3) {
        $pagamento = "Pagamento direto no hotel";
    } else if ($pagamento == 4) {
        $pagamento = "Faturado";
    } else if ($pagamento == 5) {
        $pagamento = "Debito";
    } else if ($pagamento == 6) {
        $pagamento = "Transferência bancária";
    } else if ($pagamento == 7) {
        $pagamento = " pré-pagamento (operadora pagará antecipado ao hotel)";
    } else {
        $pagamento = "Não informado";
    }
    $clientes = selecionarTodosHospedes($conexao, $id);
    $cad = 0;
    foreach ($clientes as $dad) {
        if ($dad['id'] == $id_cliente) {
            $cad = 1;
        }
    }
    if ($cad == 0) {
        cadastrarHospedeReservaHsystem($conexao, $nome, $email, $telefone, 'Não informado', $id_hotel, $id_cliente);
    }
    $data = date('Y-m-d H:i:s', strtotime($data));
    $checkin = date('Y-m-d', strtotime(dateEmMysql($checkin)));
    $checkout = date('Y-m-d', strtotime(dateEmMysql($checkout)));
    $query = "INSERT INTO `reserva`(`id`, `nome`, `telefone`, `email`, `pagamento`,`checkin`,`checkout`, `id_quarto`, `id_cliente`, `id_hotel`, `status`, `hospedes`, `valor_total`, `valor_extras`, `pre_pagamento`) VALUES ('$id', '$nome', '$telefone', '$email', '$pagamento','$checkin','$checkout', '$id_quarto', '$id_cliente', '$id_hotel', '$status', '$hospedes', '$valor_total', '$valor_extras', '$pre_pagamento')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        printf("Errormessage: %s\n", mysqli_error($conexao));
        // monta o e-mail na variavel $body

        $body = "===================================" . "\n";
        $body = $body . "GTravel - Erro" . "\n";
        $body = $body . "===================================" . "\n\n";
        $body = $body . "Deu um erro para cadastrar uma reserva no sistema, isso era o que estava na variavel resultado:\n";
        $body = $body . mysqli_error($conexao) . "\n";
        $body = $body . "===================================" . "\n";

        // envia o email
        mail('contato@marlonhenrique.com', 'GTravel - Erro ao cadastrar um reserva', $body, "From: GTravel!\r\n");
        echo '<script>alert("Falha ao cadastrar reserva, nossa equipe ja recebeu essa falha por e-mail e estamos trabalhando para resolver, tente novamente mais tarde... Descrição do erro:'.mysqli_error($conexao).'");</script>';
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

function selecionarHospedeCPF($conexao, $cpf)
{
    $query = "SELECT * FROM `hospede` WHERE `cpf` = '$cpf'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Hospede não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarHospede($conexao, $id)
{
    $query = "SELECT * FROM `hospede` WHERE `id` = '$id'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Hospede não encontrado");</script>';
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

function selecionarTodosHoteis($conexao)
{
    $query = "SELECT * FROM `hotel`";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Hotel não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodosHospedes($conexao, $id)
{
    $query = "SELECT * FROM `hospede` where `id_hotel` = '$id'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Hospede não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodasReservas($conexao, $id)
{
    $query = "SELECT * FROM `reserva` where `id_hotel` = '$id' ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodasReservasQuarto($conexao, $id)
{
    $query = "SELECT * FROM `reserva` where `id_quarto` = '$id' ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodasReservasQuartoCheckin($conexao, $id, $checkin)
{
    $query = "SELECT * FROM `reserva` where `id_quarto` = '$id' and DATE(`checkin`) = DATE('$checkin')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodosQuartos($conexao, $id)
{
    $query = "SELECT * FROM `apartamento` where `id_hotel` = '$id'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Quarto não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodasTaxas($conexao, $id)
{
    $query = "SELECT * FROM `taxa` where `id_hotel` = '$id'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Taxa não encontrada");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodosTiposQuartos($conexao, $id)
{
    $query = "SELECT * FROM `tipo_quarto` where `id_hotel` = '$id'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Tipo de quarto não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarTodosQuartosFiltro($conexao, $numero, $ordem, $id)
{
    if ($ordem == 'recentes') {
        $query = "SELECT * FROM `apartamento` where `id_hotel` = '$id' ORDER BY `id` DESC LIMIT $numero";
    } else if ($ordem == 'normal') {
        $query = "SELECT * FROM `apartamento` where `id_hotel` = '$id' ORDER BY `id` LIMIT $numero";
    } else {
        $query = "SELECT * FROM `apartamento` where `id_hotel` = '$id' ORDER BY `nome` ASC LIMIT $numero";
    }

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Quarto não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarQuarto($conexao, $id)
{
    $query = "SELECT * FROM `apartamento` WHERE `id` = $id";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Quarto não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarReserva($conexao, $id)
{
    $query = "SELECT * FROM `reserva` WHERE `id` = $id";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrada");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarReservasCliente($conexao, $id)
{
    $query = "SELECT * FROM `reserva` WHERE `id_cliente` = $id";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrada");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarReservaQuartoHoje($conexao, $id)
{
    $hoje = date('Y-m-d');
    $query = "SELECT * FROM `reserva` WHERE `id_quarto` = $id and `checkin` = '$hoje'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrada");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarReservasFuturasQuarto($conexao, $id)
{
    $hoje = date('Y-m-d');
    $query = "SELECT * FROM `reserva` WHERE `id_quarto` = $id and `checkin` > '$hoje'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Reserva não encontrada");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}


function selecionarQuartoTipo($conexao, $tipo, $capacidade)
{   
    $query = "SELECT * FROM `apartamento` WHERE `tipo` = '$tipo' and `capacidade` >= '$capacidade'";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Quarto não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarHsystem($conexao, $id)
{
    $query = "SELECT * FROM `hsystem` WHERE `id_hotel` = $id";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Hsystem não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarUltimoHospede($conexao, $id)
{
    $query = "SELECT * FROM `hospede` where `id_hotel` = '$id' ORDER BY `id` desc limit 1";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        echo '<script>alert("Hospede não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}


function capturarReservasHsystem($hotelId, $userName, $password)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://services.hunit.com.br/api/booking/read',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => 'utf-8',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '
    <reservationRQ>
        <hotelId>' . $hotelId . '</hotelId>
        <userName>' . $userName . '</userName>
        <password>' . $password . '</password>
    </reservationRQ>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $strxml = mb_convert_encoding($response, 'UTF-16', 'UTF-8');
    $json = json_encode(simplexml_load_string($strxml));
    $resultado = json_decode($json, true);
    return $resultado;
}

function capturarTiposQuarto($hotelId, $userName, $password)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://services.hunit.com.br/api/roomrate/read',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => 'utf-8',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '
    <roomRateRQ>
        <hotelId>' . $hotelId . '</hotelId>
        <userName>' . $userName . '</userName>
        <password>' . $password . '</password>
    </roomRateRQ>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $strxml = mb_convert_encoding($response, 'UTF-16', 'UTF-8');
    $json = json_encode(simplexml_load_string($strxml));
    $resultado = json_decode($json, true);
    return $resultado;
}

function AttDisponibilidadeHSYSTEM($hotelId, $userName, $password, $inicio, $fim, $id_tipo_quarto)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://services.hunit.com.br/api/availability/update',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="UTF-8"?>
<updateRQ>
<hotelId>'.$hotelId.'</hotelId>
    <userName>'.$userName.'</userName>
    <password>'.$password.'</password>
<updates>
<update>
<dateRange from="'.$inicio.'" to="'.$fim.'" sun="true" mon="true" tue="true" wed="true"
thu="true" fri="true" sat="true" />
<roomTypeId>'.$id_tipo_quarto.'</roomTypeId>
<availability>0</availability>
</update>
</updates>
</updateRQ>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml',
            'Connection: keep-alive'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $strxml = mb_convert_encoding($response, 'UTF-16', 'UTF-8');
    $json = json_encode(simplexml_load_string($strxml));
    $resultado = json_decode($json, true);
    return $resultado;
}

