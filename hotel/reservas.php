<?php include('header.php');

$dados = selecionarTodasReservas($conexao, $id);
$contador = 0;
foreach($dados as $key){
    $contador = $contador + $key['hospedes'];
}
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Reservas <span> </span></h2>
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

                        <div class="row">
                            <div class="col">
                                <h4><?php echo count($dados)." Reservas"; ?> | <?php echo count($contador)." Hospedes"; ?></h4>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <div class="row centrao">
                                    <div class="col-1">
                                        <a href="reservas.php?f=tudo">TUDO</a>
                                    </div>
                                    <div class="col centrao">
                                        <div class="dataTables_length centrao m-auto" id="basic-1_length">
                                            <label>
                                                <select name="ordenar" aria-controls="basic-1" class="">
                                                    <option value="" disabled>Filtrar por cliente</option>
                                                    <option value="10">Recentes</option>
                                                    <option value="25">Do primeiro cadastrado ao último</option>
                                                    <option value="50">ordem alfabetica</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col centrao">
                                        <div class="dataTables_length centrao m-auto" id="basic-1_length">
                                            <label>
                                                <select name="ordenar" aria-controls="basic-1" class="">
                                                    <option value="" disabled>Filtrar por quarto</option>
                                                    <option value="10">Recentes</option>
                                                    <option value="25">Do primeiro cadastrado ao último</option>
                                                    <option value="50">ordem alfabetica</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col centrao">
                                        <div class="dataTables_length centrao m-auto" id="basic-1_length">
                                            <label>
                                                <select name="ordenar" aria-controls="basic-1" class="">
                                                    <option value="" disabled>Filtrar por tipo de pagamento</option>
                                                    <option value="10">A vista</option>
                                                    <option value="25">Do primeiro cadastrado ao último</option>
                                                    <option value="50">ordem alfabetica</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Check-In</label>
                                            <input type="datetime-local" name="checkin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Check-Out</label>
                                            <input type="datetime-local" name="checkout" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Data de cadastro</label>
                                            <input type="datetime-local" name="data" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="basic-1_filter" class="dataTables_filter">
                                            <label class="maximo">
                                                <input type="search" class="form-control" placeholder="Busque dados da reserva para filtrar" aria-controls="basic-1" name="busca" style="margin-left: 0;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
                                            foreach ($dados as $key) {
                                                $quarto = selecionarQuarto($conexao, $key['id_quarto']);
                                                $res = AttDisponibilidadeHSYSTEM($hotelId, $userNameHsystem, $password, date('Y/m/d', strtotime($key['checkin'])), date('Y/m/d', strtotime($key['checkout'])), $quarto['id_tipo']);
                                        ?>
                                                <tr>
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#reserva'.$key['id']; ?>"><?php echo $key['id']; ?></a></td>
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#status'.$key['id']; ?>"><?php echo $key['status']; ?></a></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#ver'.$key['id_cliente']; ?>"><?php echo $key['nome']; ?></td>
                                                    <td><?php echo $quarto['nome']; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($key['checkin'])); ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($key['checkout'])); ?></td>
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#pagamento'.$key['id']; ?>"><?php echo "R$".$key['valor_total'];?></a></td>
                                                    <td><?php echo "R$".$key['pre_pagamento'];?></td>
                                                    <td><?php echo "R$".($key['valor_total']-$key['pre_pagamento']-$key['valor_descontos']); ?></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#acoes'.$key['id']; ?>"><i class="fas fa-id-card-alt"></i></a></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <h4>Nenhuma reserva cadastrada no sistema, <a href="nova-reserva.php">Cadastre sua primeira reserva agora</a></h4>
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

<?php foreach($dados as $res) { 
    $key = selecionarHospede($conexao, $res['id_cliente']);    
?>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'status'.$res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Defina um novo status para a reserva <?php echo $res['id']; ?></h5>
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
        <input type="hidden" name="id" value="<?php echo $res['id'];?>"> 
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
<div class="modal fade" id="<?php echo 'pagamento'.$res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Defina um valor já pago pelo cliente para a reserva <?php echo $res['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="alterar.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Quanto <?php echo $res['nome'];?> já pagou para esta reserva?</label>
            <input type="number" step="0.01" class="form-control" id="dinheiro" name="pre_pagamento">
        </div>     
        <input type="hidden" name="id" value="<?php echo $res['id'];?>"> 
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
<div class="modal fade" id="<?php echo 'reserva'.$res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações sobre a reserva <?php echo $res['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-12">
                <h5>ID: <span><?php echo $res['id']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CPF/CNPJ: <span><?php echo $res['cpf_cnpj']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>RG: <span><?php echo $res['rg']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome: <span><?php echo $res['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Telefone: <span><?php echo $res['telefone']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>E-mail: <span><?php echo $res['email']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CNPJ da empresa: <span><?php echo $res['cpf_cnpj_empresa']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome da empresa: <span><?php echo $res['nome_empresa']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Pagamento: <span><?php echo $res['pagamento']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Check-in: <span><?php echo date('d/m/Y',strtotime($res['checkin'])); ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Check-out: <span><?php echo date('d/m/Y',strtotime($res['checkout'])); ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Data de cadastro da reserva: <span><?php echo date('d/m/Y H:i:s',strtotime($res['data'])); ?></span></h5>
            </div>
            <?php $quarto = selecionarQuarto($conexao, $res['id_quarto']); ?>
            <div class="col-12">
                <h5>Quarto: <span><?php echo $quarto['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>ID do cliente: <span><?php echo $res['id_cliente']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Status: <span><?php echo $res['status']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Hospedes: <span><?php echo $res['hospedes']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Pré-pagamento: <span><?php echo "R$".$res['pre_pagamento']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Não reembolsável: <span><?php echo "R$".$res['nao_reembolsavel']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor total já cobrado: <span><?php echo "R$".$res['valor_cobrado']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor das diarias: <span><?php echo "R$".$res['valor_diarias']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Extras: <span><?php echo "R$".$res['valor_extras']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Taxas: <span><?php echo "R$".$res['valor_taxas']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Descontos: <span><?php echo "R$".$res['valor_descontos']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor Que Ainda Deve Ser Pago: <span><?php echo "R$".($res['valor_total']-$res['pre_pagamento']-$res['valor_descontos']); ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor Total: <span><?php echo "R$".$res['valor_total']; ?></span></h5>
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
<div class="modal fade" id="<?php echo 'ver'.$key['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações sobre <?php echo $key['nome']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-12">
                <h5>ID: <span><?php echo $key['id']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome: <span><?php echo $key['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CPF: <span><?php echo $key['cpf']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>E-mail: <span><?php echo $key['email']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Telefone: <span><?php echo $key['telefone']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Rua: <span><?php echo $key['rua']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Numero: <span><?php echo $key['numero']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Complemento: <span><?php echo $key['complemento']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>CEP: <span><?php echo $key['cep']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Bairro: <span><?php echo $key['bairro']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Cidade: <span><?php echo $key['cidade']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>UF: <span><?php echo $key['estado']; ?></span></h5>
            </div>
            <div class="col-12">
            <?php // separando yyyy, mm, ddd
                list($ano, $mes, $dia) = explode('-', $key['idade']);

                // data atual
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                // Descobre a unix timestamp da data de nascimento do fulano
                $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

                // cálculo
                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                ?>
                <h5>Idade: <span><?php if(empty($key['idade'])){ echo '0'; } else { echo $idade; } ?></span></h5>
            </div>
            <div class="col-6">
                <h5>Sexo: <span><?php echo $key['sexo']; ?></span></h5>
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
<div class="modal fade" id="<?php echo 'acoes'.$res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
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
            <a href="editar-reserva.php?id=<?php echo $res['id'];?>" class="btn btn-primary" style="width: 100%;">Editar Reserva</a>
        </div>
        <div class="col-md-6" style="margin-bottom: 10px;">        
            <button type="button" class="btn btn-warning" style="width: 100%;">Cancelar Reserva</button>
        </div>
        <div class="col-md-6" style="margin-bottom: 10px;">
            <button type="button" class="btn btn-danger" style="width: 100%;" onclick="deletar(<?php echo $res['id'];?>, 'reserva')">Excluir Reserva</button>
        </div>
        <div class="col-md-6" style="margin-bottom: 10px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Fechar</button>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
<? } ?>

<?php include('footer.php'); ?>