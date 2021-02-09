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
    cadastrarQuarto($conexao, $nome, $tipo, $capacidade, $obs, $id_hotel);
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
        $cliente = selecionarUltimoHospede($conexao);
        $id_cliente = $cliente['id'];
    } else {
        $id_cliente = $clientes['id'];
    }
    cadastrarReserva($conexao, $cpf_cnpj, $rg, $nome, $telefone, $email, $cpf_cnpj_empresa, $nome_empresa, $pagamento, $checkin, $checkout, $data, $id_quarto, $id_cliente, $id_hotel, $status, $hospedes);
}