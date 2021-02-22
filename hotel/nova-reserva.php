<?php include('header.php'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Cadastrar<span> Reserva</span></h2>
                    <h6 class="mb-0">Nova Reserva</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Cadastrar Reserva</li>
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
                            <h4 class="card-title mb-0">Reserva</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="cadastrar.php">
                                <span class="titulo-form">HOSPEDE</span>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <input type="text" class="form-control" name="cpf_cnpj" required placeholder="CPF ou CNPJ do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input type="text" class="form-control" name="rg" required placeholder="RG do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" name="nome" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <input type="text" class="form-control" name="telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                                <span class="titulo-form">EMPRESA</span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <input type="text" class="form-control" name="cpf_cnpj_empresa">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="nome_empresa">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Numero de hospedes</label>
                                            <input type="number" class="form-control" name="hospedes">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Check-In</label>
                                            <input type="date" class="form-control" name="checkin" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Check-Out</label>
                                            <input type="date" class="form-control" name="checkout">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>UH</label>
                                            <?php $dados = selecionarTodosQuartos($conexao, $id); ?>
                                            <select name="quarto" class="form-control">
                                                <?php foreach ($dados as $key) { ?>}
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
                                            <label>Pré Pagamento</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="pre_pagamento">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Não Reembolsável</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="nao_reembolsavel">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valor Que Já Foi Pago</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_cobrado">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valor Das Diarias</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_diarias">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valores Extras</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_extras">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Taxas</label>
                                            <?php $taxa = selecionarTodasTaxas($conexao, $id); ?>
                                            <select name="valor_taxas" class="form-control">
                                                <option value="">Selecione uma taxa</option>
                                                <?php foreach ($taxa as $key) { ?>}
                                                    <option value="<?php echo $key['valor']; ?>"><?php echo $key['nome']." R$".$key['valor']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <small>Não tem nenhuma taxa cadastrada? <a href="#"  data-toggle="modal" data-target="#taxa">Clique aqui para cadastrar</a></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Descontos</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_descontos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor_total">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Pago">Pago</option>
                                                <option value="Pendente">Pendente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pagamento</label>
                                            <select name="pagamento" class="form-control">
                                                <option value="A vista">A vista</option>
                                                <option value="Credito">Credito</option>
                                                <option value="Debito">Debito</option>
                                                <option value="Deposito">Deposito</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="op" value="reserva">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-pill">Cadastrar</button>
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

<div class="modal fade" id="taxa" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Nova Taxa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="cadastrar.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome">
        </div> 
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control" name="descricao">
        </div>  
        <div class="form-group">
            <label>Valor</label>
            <input type="number" step="0.01" class="form-control" id="dinheiro" name="valor">
        </div>   
        <input type="hidden" name="id" value="<?php echo $id;?>"> 
        <input type="hidden" name="op" value="taxa"> 

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Cadastrar nova taxa</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>