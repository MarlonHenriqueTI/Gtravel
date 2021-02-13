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

if($op == 'quarto') {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $obs = $_POST['obs'];
    $id_hotel = $_POST['id'];
    $tipos = capturarTiposQuarto($hotelId, $userNameHsystem, $password);
    foreach($tipos['roomRate'] as $quarto){
        if($quarto['@attributes']['id'] == $tipo){
            $nome_quarto = $quarto['@attributes']['name'];
        }
    }
    cadastrarQuarto($conexao, $nome, $nome_quarto, $capacidade, $obs, $id_hotel, $tipo);
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

if($op == 'hospede') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $complemento = $_POST['complemento'];
    $cpf = $_POST['cpf'];
    $id_hotel = $_POST['id'];
    cadastrarHospede($conexao, $nome, $email, $telefone, $rua, $numero, $cep, $bairro, $estado, $cidade, $idade, $sexo, $complemento, $cpf, $id_hotel);
}

if($op == 'reserva') {
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $rg = $_POST['rg'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf_cnpj_empresa = $_POST['cpf_cnpj_empresa'];
    $nome_empresa = $_POST['nome_empresa'];
    $pagamento = $_POST['pagamento'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $id_quarto = $_POST['quarto'];
    $id_hotel = $_POST['id'];
    $status = $_POST['status'];
    $hospedes = $_POST['hospedes'];
    $clientes = selecionarHospedeCPF($conexao, $cpf_cnpj);
    if(empty($clientes)){
        cadastrarHospedeReserva($conexao, $nome, $email, $telefone, $cpf_cnpj, $id_hotel);
        $cliente = selecionarUltimoHospede($conexao, $id_hotel);
        $id_cliente = $cliente['id'];
    } else {
        $id_cliente = $clientes['id'];
    }
    if(!empty($_POST['pre_pagamento'])){
        $pre_pagamento = $_POST['pre_pagamento'];
    } else {
        $pre_pagamento = 0.00;
    }
    
    if(!empty($_POST['nao_reembolsavel'])){
        $nao_reembolsavel = $_POST['nao_reembolsavel'];
    } else {
        $$nao_reembolsavel = 0.00;
    }

    if(!empty($_POST['valor_cobrado'])){
        $valor_cobrado = $_POST['valor_cobrado'];
    } else {
        $valor_cobrado = 0.00;
    }
    
    if(!empty($_POST['valor_diarias'])){
        $valor_diarias = $_POST['valor_diarias'];
    } else {
        $valor_diarias = 0.00;
    }
    
    if(!empty($_POST['valor_extras'])){
        $valor_extras = $_POST['valor_extras'];
    } else {
        $valor_extras = 0.00;
    }
    
    if(!empty($_POST['valor_taxas'])){
        $valor_taxas = $_POST['valor_taxas'];
    } else {
        $valor_taxas = 0.00;
    }
    
    if(!empty($_POST['valor_descontos'])){
        $valor_descontos = $_POST['valor_descontos'];
    } else {
        $valor_descontos = 0.00;
    }
   
    if(!empty($_POST['valor_total'])){
        $valor_total = $_POST['valor_total'];
    } else {
        $valor_total = 0.00;
    }

    $reservas = selecionarTodasReservasQuarto($conexao, $id_quarto);
    foreach($reservas as $key){
        if(($checkin >= $key['checkin']) && ($checkin <= $key['checkout'])){
            echo '<script>alert("Este quarto não esta disponivel para esta data!");window.history.back();</script>';
        } else if(($chekout >= $key['checkin']) && ($checkout <= $key['checkout'])){
            echo '<script>alert("Este quarto não esta disponivel para esta data!");window.history.back();</script>';
        } else {
            cadastrarReserva($conexao, $cpf_cnpj, $rg, $nome, $telefone, $email, $cpf_cnpj_empresa, $nome_empresa, $pagamento, $checkin, $checkout, $id_quarto, $id_cliente, $id_hotel, $status, $hospedes, $pre_pagamento, $nao_reembolsavel, $valor_cobrado, $valor_diarias, $valor_extras, $valor_taxas, $valor_descontos, $valor_total);
        }
    }
}