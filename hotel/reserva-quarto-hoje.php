<?php include('header.php');

$id_quarto = $_GET['id'];
$dados = selecionarReservaQuartoHoje($conexao, $id_quarto);

?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Reserva Hoje<span> </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active">Reservas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th>id</th>
                                            <th>Status</th>
                                            <th>Hóspede</th>
                                            <th>UH</th>
                                            <th>Check-in</th>
                                            <th>Check-Out</th>
                                            <th>Total</th>    
                                            <th>Valor Pago</th>
                                            <th>Valor A Pagar</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($dados)) {
                                                $quarto = selecionarQuarto($conexao, $dados['id_quarto']);
                                        ?>
                                                <tr>
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#reserva'.$dados['id']; ?>"<?php if($dados['processo'] == 'disponivel'){?>style="color:#4BCC72 ;"<?php } else if($dados['processo'] == 'checkout'){?>style="color:red ;"<?php } else if($dados['processo'] == 'limpeza'){?>style="color:blue ;"<?php } else { ?>style="color:orange ;"<?php } ?>><?php echo $dados['id']; ?></a></td>
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#status'.$dados['id']; ?>"><?php echo $dados['status']; ?></a></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#ver'.$dados['id_cliente']; ?>"><?php echo $dados['nome']; ?></td>
                                                    <td><?php echo $quarto['nome']; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($dados['checkin'])); ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($dados['checkout'])); ?></td>
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#pagamento'.$dados['id']; ?>"><?php echo "R$".$dados['valor_total'];?></a></td>
                                                    <td><?php echo "R$".$dados['pre_pagamento'];?></td>
                                                    <td><?php echo "R$".($dados['valor_total']-$dados['pre_pagamento']-$dados['valor_descontos']); ?></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#acoes'.$dados['id']; ?>"><i class="fas fa-id-card-alt"></i></a></td>
                                                </tr>
                                            <?php }
                                         else { ?>
                                            <h4>Nenhuma Reserva Para Este Quarto Hoje</a></h4>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

<?php 
    $hospede = selecionarHospede($conexao, $dados['id_cliente']);    
?>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'status'.$dados['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Defina um novo status para a reserva <?php echo $dados['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="alterar.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Digite o novo status</label>
            <input type="text" class="form-control" required name="status">
        </div>     
        <input type="hidden" name="id" value="<?php echo $dados['id'];?>"> 
        <input type="hidden" name="op" value="status"> 

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Alterar Status</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'pagamento'.$dados['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Defina um valor já pago pelo cliente para a reserva <?php echo $dados['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="alterar.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Quanto <?php echo $dados['nome'];?> já pagou para esta reserva?</label>
            <input type="number" step="0.01" class="form-control" id="dinheiro" name="pre_pagamento">
        </div>     
        <input type="hidden" name="id" value="<?php echo $dados['id'];?>"> 
        <input type="hidden" name="op" value="pre-pagamento"> 

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Definir valor pago</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'reserva'.$dados['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações sobre a reserva <?php echo $dados['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-12">
                <?php if($dados['processo'] == 'disponivel') { ?>
                    <h5 style="color:#4BCC72 ;">Aguardando Hospede</h5>
                <?php } else if($dados['processo'] == 'checkin'){?>
                    <h5 style="color:#4BCC72 ;">Checkin Realizado</h5>
                <?php } else if($dados['processo'] == 'checkout'){?>
                    <h5 style="color:#4BCC72 ;">Checkout Realizado</h5>
                <?php } else if($dados['processo'] == 'limpeza'){?>
                    <h5 style="color:#4BCC72 ;">Enviado Para Limpeza</h5>
                <?php } ?>
            </div>
            <div class="col-12">
                <h5>ID: <span><?php echo $dados['id']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CPF/CNPJ: <span><?php echo $dados['cpf_cnpj']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>RG: <span><?php echo $dados['rg']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome: <span><?php echo $dados['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Telefone: <span><?php echo $dados['telefone']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>E-mail: <span><?php echo $dados['email']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CNPJ da empresa: <span><?php echo $dados['cpf_cnpj_empresa']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome da empresa: <span><?php echo $dados['nome_empresa']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Pagamento: <span><?php echo $dados['pagamento']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Check-in: <span><?php echo date('d/m/Y',strtotime($dados['checkin'])); ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Check-out: <span><?php echo date('d/m/Y',strtotime($dados['checkout'])); ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Data de cadastro da reserva: <span><?php echo date('d/m/Y H:i:s',strtotime($dados['data'])); ?></span></h5>
            </div>
            <?php $quarto = selecionarQuarto($conexao, $dados['id_quarto']); ?>
            <div class="col-12">
                <h5>Quarto: <span><?php echo $quarto['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>ID do cliente: <span><?php echo $dados['id_cliente']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Status: <span><?php echo $dados['status']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Hospedes: <span><?php echo $dados['hospedes']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Pré-pagamento: <span><?php echo "R$".$dados['pre_pagamento']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Não reembolsável: <span><?php echo "R$".$dados['nao_reembolsavel']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor total já cobrado: <span><?php echo "R$".$dados['valor_cobrado']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor das diarias: <span><?php echo "R$".$dados['valor_diarias']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Extras: <span><?php echo "R$".$dados['valor_extras']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Taxas: <span><?php echo "R$".$dados['valor_taxas']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Descontos: <span><?php echo "R$".$dados['valor_descontos']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor Que Ainda Deve Ser Pago: <span><?php echo "R$".($dados['valor_total']-$dados['pre_pagamento']-$dados['valor_descontos']); ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor Total: <span><?php echo "R$".$dados['valor_total']; ?></span></h5>
            </div>
      </div>
      </div>
      <div class="modal-footer">
      <?php if($dados['processo'] == 'disponivel') { ?>
        <a href="alterar.php?id=<?php echo $dados['id']; ?>&op=processo&processo=checkin&id_quarto=<?php echo $dados['id_quarto']; ?>"  class="btn btn-primary">Fazer Checkin</a>
        <?php } else if($dados['processo'] == 'checkin'){?>
        <a href="alterar.php?id=<?php echo $dados['id']; ?>&op=processo&processo=checkout&id_quarto=<?php echo $dados['id_quarto']; ?>"  class="btn btn-danger">Fazer Checkout</a>
        <?php } else if($dados['processo'] == 'checkout'){?>
        <a href="alterar.php?id=<?php echo $dados['id']; ?>&op=processo&processo=limpeza&id_quarto=<?php echo $dados['id_quarto']; ?>"  class="btn btn-dark">Enviar Quarto Para A Limpeza</a>
        <?php } ?>        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'ver'.$hospede['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações sobre <?php echo $hospede['nome']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-12">
                <h5>ID: <span><?php echo $hospede['id']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome: <span><?php echo $hospede['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CPF: <span><?php echo $hospede['cpf']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>E-mail: <span><?php echo $hospede['email']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Telefone: <span><?php echo $hospede['telefone']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Rua: <span><?php echo $hospede['rua']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Numero: <span><?php echo $hospede['numero']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Complemento: <span><?php echo $hospede['complemento']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CEP: <span><?php echo $hospede['cep']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Bairro: <span><?php echo $hospede['bairro']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Cidade: <span><?php echo $hospede['cidade']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>UF: <span><?php echo $hospede['estado']; ?></span></h5>
            </div>
            <div class="col-12">
            <?php // separando yyyy, mm, ddd
                list($ano, $mes, $dia) = explode('-', $hospede['idade']);

                // data atual
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                // Descobre a unix timestamp da data de nascimento do fulano
                $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

                // cálculo
                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                ?>
                <h5>Idade: <span><?php if(empty($hospede['idade'])){ echo '0'; } else { echo $hospede; } ?></span></h5>
            </div>
            <div class="col-6">
                <h5>Sexo: <span><?php echo $hospede['sexo']; ?></span></h5>
            </div>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'acoes'.$dados['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ações</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        O que você deseja?
      </div>
      <div class="modal-footer">
      <div class="row">
        <div class="col-md-6" style="margin-bottom: 10px;">
            <a href="editar-reserva.php?id=<?php echo $dados['id'];?>" class="btn btn-primary" style="width: 100%;">Editar Reserva</a>
        </div>
        <div class="col-md-6" style="margin-bottom: 10px;">        
            <button type="button" class="btn btn-warning" style="width: 100%;">Cancelar Reserva</button>
        </div>
        <div class="col-md-6" style="margin-bottom: 10px;">
            <button type="button" class="btn btn-danger" style="width: 100%;" onclick="deletar(<?php echo $dados['id'];?>, 'reserva')">Excluir Reserva</button>
        </div>
        <div class="col-md-6" style="margin-bottom: 10px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Fechar</button>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>