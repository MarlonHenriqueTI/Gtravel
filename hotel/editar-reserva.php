<?php include('header.php'); 

$id_reserva = $_GET['id'];
$dados = selecionarReserva($conexao, $id_reserva);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Editar<span> Reserva</span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Editar Reserva</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Editar Reserva <?php echo $dados['id']; ?></h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="alterar.php">
                                <span class="titulo-form">HOSPEDE</span>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <input type="text" class="form-control" value="<?php echo $dados['cpf_cnpj']; ?>" name="cpf_cnpj"  placeholder="CPF ou CNPJ do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input type="text" class="form-control" value="<?php echo $dados['rg']; ?>" name="rg"  placeholder="RG do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" name="nome"  class="form-control" value="<?php echo $dados['nome']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <input type="text" class="form-control" value="<?php echo $dados['telefone']; ?>" name="telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $dados['email']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <span class="titulo-form">EMPRESA</span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <input type="text" class="form-control" name="cpf_cnpj_empresa" value="<?php echo $dados['cpf_cnpj_empresa']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="nome_empresa" value="<?php echo $dados['nome_empresa']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Numero de hospedes</label>
                                            <input type="number" class="form-control" name="hospedes" value="<?php echo $dados['hospedes']; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="titulo-form">Check-In</label>
                                            <input type="date" class="form-control" name="checkin"  value="<?php echo $dados['checkin']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="titulo-form">Check-Out</label>
                                            <input type="date" class="form-control" name="checkout" value="<?php echo $dados['checkout']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="titulo-form">UH</label>
                                            <?php $quartos = selecionarTodosQuartos($conexao, $id); 
                                                $quarto = selecionarQuarto($conexao, $dados['id_quarto']);
                                            ?>
                                            <select name="quarto" class="form-control">
                                                <option value="<?php echo $dados['id_quarto']; ?>"><?php echo $quarto['nome']; ?></option>
                                                <?php foreach ($quartos as $key) { ?>}
                                                <option value="<?php echo $key['id']; ?>"><?php echo $key['nome']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <span class="titulo-form">PAGAMENTO</span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Pré Pagamento</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="pre_pagamento" value="<?php echo $dados['pre_pagamento']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Não Reembolsável</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="nao_reembolsavel" value="<?php echo $dados['nao_reembolsavel']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Valor Que Já Foi Pago</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_cobrado" value="<?php echo $dados['valor_cobrado']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Valor Das Diarias</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_diarias" value="<?php echo $dados['valor_diarias']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Valores Extras</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_extras" value="<?php echo $dados['valor_extras']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Taxas</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_taxas" value="<?php echo $dados['valor_taxas']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Descontos</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_descontos" value="<?php echo $dados['valor_descontos']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Total</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_total" value="<?php echo $dados['valor_total']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Status</label>
                                            <input type="text" class="form-control" name="status" value="<?php echo $dados['status']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Pagamento</label>
                                            <input type="text" class="form-control" name="pagamento" value="<?php echo $dados['pagamento']; ?>">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="op" value="reserva">
                                <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-pill">Editar reserva</button>
                                    <a href="reservas.php" class="btn btn-secondary btn-block btn-pill">Voltar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>


<?php include('footer.php'); ?>