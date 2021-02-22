<?php

include('header.php');

$op = $_POST['op'];
if(empty($op)){
    $op = $_GET['op'];
}

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

if ($op == 'hsystem') {
    $id_hotel = $_POST['id'];
    $hotelId = $_POST['hotelId'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `hsystem` WHERE `id_hotel` = '$id_hotel'";
    $resultado = mysqli_query($conexao, $query);
    $numResults = mysqli_num_rows($resultado);
    if ($numResults > 0) {
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
    } else {
        cadastrarHsystem($conexao, $id_hotel, $hotelId, $userName, $password);
    }
}

if($op == 'status'){
    $id_reserva = $_POST['id'];
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        alterar($id_reserva, 'reserva', 'status', $status, $conexao);
    }
    echo '<script>alert("Sucesso...");window.history.back();</script>';
}

if($op == 'pre-pagamento'){
    $id_reserva = $_POST['id'];
    if (isset($_POST['pre_pagamento'])) {
        $pre_pagamento = $_POST['pre_pagamento'];
        alterar($id_reserva, 'reserva', 'pre_pagamento', $pre_pagamento, $conexao);
    }
    echo '<script>alert("O novo valor de R$'.$pre_pagamento.' foi adicionado a reserva!");window.history.back();</script>';
}

if($op == 'reserva'){
    $id_reserva = $_POST['id'];
    if (isset($_POST['cpf_cnpj'])) {
        $cpf_cnpj = $_POST['cpf_cnpj'];
        alterar($id_reserva, 'reserva', 'cpf_cnpj', $cpf_cnpj, $conexao);
    }
    if (isset($_POST['rg'])) {
        $rg = $_POST['rg'];
        alterar($id_reserva, 'reserva', 'rg', $rg, $conexao);
    }
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        alterar($id_reserva, 'reserva', 'nome', $nome, $conexao);
    }
    if (isset($_POST['telefone'])) {
        $telefone = $_POST['telefone'];
        alterar($id_reserva, 'reserva', 'telefone', $telefone, $conexao);
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        alterar($id_reserva, 'reserva', 'email', $email, $conexao);
    }
    if (isset($_POST['cpf_cnpj_empresa'])) {
        $cpf_cnpj_empresa = $_POST['cpf_cnpj_empresa'];
        alterar($id_reserva, 'reserva', 'cpf_cnpj_empresa', $cpf_cnpj_empresa, $conexao);
    }
    if (isset($_POST['nome_empresa'])) {
        $nome_empresa = $_POST['nome_empresa'];
        alterar($id_reserva, 'reserva', 'nome_empresa', $nome_empresa, $conexao);
    }
    if (isset($_POST['pagamento'])) {
        $pagamento = $_POST['pagamento'];
        alterar($id_reserva, 'reserva', 'pagamento', $pagamento, $conexao);
    }
    if (isset($_POST['checkin'])) {
        $checkin = $_POST['checkin'];
        alterar($id_reserva, 'reserva', 'checkin', $checkin, $conexao);
    }
    if (isset($_POST['checkout'])) {
        $checkout = $_POST['checkout'];
        alterar($id_reserva, 'reserva', 'checkout', $checkout, $conexao);
    }
    if (isset($_POST['quarto'])) {
        $id_quarto = $_POST['quarto'];
        alterar($id_reserva, 'reserva', 'id_quarto', $id_quarto, $conexao);
    }
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        alterar($id_reserva, 'reserva', 'status', $status, $conexao);
    }
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        alterar($id_reserva, 'reserva', 'status', $status, $conexao);
    }
    if (isset($_POST['hospedes'])) {
        $hospedes = $_POST['hospedes'];
        alterar($id_reserva, 'reserva', 'hospedes', $hospedes, $conexao);
    }
    if (isset($_POST['pre_pagamento'])) {
        $pre_pagamento = $_POST['pre_pagamento'];
        alterar($id_reserva, 'reserva', 'pre_pagamento', $pre_pagamento, $conexao);
    }
    
    if (isset($_POST['nao_reembolsavel'])) {
        $nao_reembolsavel = $_POST['nao_reembolsavel'];
        alterar($id_reserva, 'reserva', 'nao_reembolsavel', $nao_reembolsavel, $conexao);
    }
    
    if (isset($_POST['valor_cobrado'])) {
        $valor_cobrado = $_POST['valor_cobrado'];
        alterar($id_reserva, 'reserva', 'valor_cobrado', $valor_cobrado, $conexao);
    }
    
    if (isset($_POST['valor_diarias'])) {
        $valor_diarias = $_POST['valor_diarias'];
        alterar($id_reserva, 'reserva', 'valor_diarias', $valor_diarias, $conexao);
    }
    
    if (isset($_POST['valor_extras'])) {
        $valor_extras = $_POST['valor_extras'];
        alterar($id_reserva, 'reserva', 'valor_extras', $valor_extras, $conexao);
    }
    
    if (isset($_POST['valor_taxas'])) {
        $valor_taxas = $_POST['valor_taxas'];
        alterar($id_reserva, 'reserva', 'valor_taxas', $valor_taxas, $conexao);
    }
    
    if (isset($_POST['valor_descontos'])) {
        $valor_descontos = $_POST['valor_descontos'];
        alterar($id_reserva, 'reserva', 'valor_descontos', $valor_descontos, $conexao);
    }
 
    if (isset($_POST['valor_total'])) {
        $valor_total = $_POST['valor_total'];
        alterar($id_reserva, 'reserva', 'valor_total', $valor_total, $conexao);
    }
    
    echo '<script>alert("Reserva atualizada com sucesso!");window.history.back();</script>';
}

if($op == "quarto"){
    $id_quarto = $_POST['id'];
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        alterar($id_quarto, 'apartamento', 'nome', $nome, $conexao);
    }
    if (isset($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
        alterar($id_quarto, 'apartamento', 'tipo', $tipo, $conexao);
    }
    if (isset($_POST['capacidade'])) {
        $capacidade = $_POST['capacidade'];
        alterar($id_quarto, 'apartamento', 'capacidade', $capacidade, $conexao);
    }
    if (isset($_POST['obs'])) {
        $obs = $_POST['obs'];
        alterar($id_quarto, 'apartamento', 'obs', $obs, $conexao);
    }
    if (isset($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
        $tipos = capturarTiposQuarto($hotelId, $userNameHsystem, $password);
        foreach($tipos['roomRate'] as $quarto){
            if($quarto['@attributes']['id'] == $tipo){
                $nome_quarto = $quarto['@attributes']['name'];
            }
        }
        alterar($id_quarto, 'apartamento', 'tipo', $nome_quarto, $conexao);
        alterar($id_quarto, 'apartamento', 'id_tipo', $tipo, $conexao);
    }    
    echo '<script>alert("Quarto atualizado com sucesso!");window.history.back();</script>';
}


if($op == 'hospede') {
    $id_cliente = $_POST['id'];
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        alterar($id_cliente, 'hospede', 'nome', $nome, $conexao);
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        alterar($id_cliente, 'hospede', 'email', $email, $conexao);
    }
    if (isset($_POST['telefone'])) {
        $telefone = $_POST['telefone'];
        alterar($id_cliente, 'hospede', 'telefone', $telefone, $conexao);
    }
    if (isset($_POST['rua'])) {
        $rua = $_POST['rua'];
        alterar($id_cliente, 'hospede', 'rua', $rua, $conexao);
    }
    if (isset($_POST['numero'])) {
        $numero = $_POST['numero'];
        alterar($id_cliente, 'hospede', 'numero', $numero, $conexao);
    }
    if (isset($_POST['cep'])) {
        $cep = $_POST['cep'];
        alterar($id_cliente, 'hospede', 'cep', $cep, $conexao);
    }
    if (isset($_POST['bairro'])) {
        $bairro = $_POST['bairro'];
        alterar($id_cliente, 'hospede', 'bairro', $bairro, $conexao);
    }
    if (isset($_POST['uf'])) {
        $estado = $_POST['uf'];
        alterar($id_cliente, 'hospede', 'estado', $estado, $conexao);
    }
    if (isset($_POST['cidade'])) {
        $cidade = $_POST['cidade'];
        alterar($id_cliente, 'hospede', 'cidade', $cidade, $conexao);
    }
    if (isset($_POST['idade'])) {
        $idade = $_POST['idade'];
        alterar($id_cliente, 'hospede', 'idade', $idade, $conexao);
    }
    if (isset($_POST['sexo'])) {
        $sexo = $_POST['sexo'];
        alterar($id_cliente, 'hospede', 'sexo', $sexo, $conexao);
    }
    if (isset($_POST['complemento'])) {
        $complemento = $_POST['complemento'];
        alterar($id_cliente, 'hospede', 'complemento', $complemento, $conexao);
    }
    if (isset($_POST['cpf'])) {
        $cpf = $_POST['cpf'];
        alterar($id_cliente, 'hospede', 'cpf', $cpf, $conexao);
    }
    echo '<script>alert("Hospede atualizado com sucesso!");window.history.back();</script>';
}

if($op == 'disponibilidade'){
    $id_quarto = $_POST['id'];
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        alterar($id_quarto, 'apartamento', 'status', $status, $conexao);
    }
    echo '<script>alert("Quarto definido como '.$_POST['status'].'");window.history.back();</script>';
}

if($op == 'processo'){
    $id_reserva = $_GET['id'];
    $id_quarto = $_GET['id_quarto'];
    if (isset($_GET['processo'])) {
        $processo = $_GET['processo'];
        alterar($id_reserva, 'reserva', 'processo', $processo, $conexao);
    }

    if($processo == 'checkin'){
        alterar($id_quarto, 'apartamento', 'status', 'Ocupado', $conexao);
        echo '<script>alert("Checkin Realizado com sucesso");window.history.back();</script>';
    } else if($processo == 'checkout'){
        alterar($id_quarto, 'apartamento', 'status', 'Limpeza', $conexao);
        echo '<script>alert("Checkout Realizado com sucesso");window.history.back();</script>';
    } else {
        echo '<script>alert("Sucesso");window.history.back();</script>';
    }
}

if($op == 'bloquear'){
    $id_quarto = $_GET['id'];
    alterar($id_quarto, 'apartamento', 'bloqueado', 1, $conexao);
    echo '<script>alert("Quarto Bloqueado");window.history.back();</script>';
}

if($op == 'desbloquear'){
    $id_quarto = $_GET['id'];
    alterar($id_quarto, 'apartamento', 'bloqueado', 0, $conexao);
    echo '<script>alert("Quarto Desbloqueado");window.history.back();</script>';
}