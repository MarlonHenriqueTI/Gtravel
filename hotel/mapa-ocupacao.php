<?php include('header.php');

$quartos = selecionarTodosQuartos($conexao, $id);
$dados = selecionarTodasReservas($conexao, $id);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Mapa de <span>Ocupação </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active">Mapa de ocupação</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="table-responsive">
            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                    <thead>
                        <tr role="row">
                            <th>UH</th>
                            <th><?php echo date('d/m'); ?></th>
                            <th><?php echo date('d/m', strtotime("+ 1 day")); ?></th>
                            <?php $i = 2;
                            while ($i <= 30) { ?>
                                <th><?php echo date('d/m', strtotime("+ $i days")); ?></th>
                            <?php $i++;
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($quartos as $key) {
                        ?>
                            <tr>
                                <td><strong><?php echo $key['nome']; ?></strong></td>
                                <?php $j = 0;
                                while ($j <= 30) {
                                    if ($j == 0) {
                                        $reserva = selecionarTodasReservasQuartoCheckin($conexao, $key['id'], date('Y-m-d'));
                                    } else if ($j == 1) {
                                        $reserva = selecionarTodasReservasQuartoCheckin($conexao, $key['id'], date('Y-m-d', strtotime("+ 1 day")));
                                    } else {
                                        $reserva = selecionarTodasReservasQuartoCheckin($conexao, $key['id'], date('Y-m-d', strtotime("+ $j days")));
                                    }
                                    $diferenca = strtotime($reserva[0]['checkout']) - strtotime($reserva[0]['checkin']);
                                    $dias = $diferenca / (60 * 60 * 24);
                                    if (empty($reserva)) {
                                ?>
                                        <td class="com-borda"></td>
                                    <?php } else {
                                    ?>
                                        <td class="com-borda" colspan="<?php echo $dias; ?>"><a href="#" <?php if($reserva[0]['processo'] == 'disponivel'){?>class="btn btn-primary"<?php } else if($reserva[0]['processo'] == 'checkout'){?>class="btn btn-danger"<?php } else if($reserva[0]['processo'] == 'limpeza'){?>class="btn btn-dark"<?php } else { ?>class="btn btn-warning"<?php } ?>  id="reserva-mapa" data-toggle="modal" data-target="<?php echo '#reserva'.$reserva[0]['id']; ?>"><?php echo $reserva[0]['nome']; ?></a></td>
                                <?php }
                                    if ($dias == 0) {
                                        $j++;
                                    } else {
                                        $j = $j + $dias;
                                    }
                                } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>


<?php foreach($dados as $res) { ?>


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
                <?php if($res['processo'] == 'disponivel') { ?>
                    <h5 style="color:#4BCC72 ;">Aguardando Hospede</h5>
                <?php } else if($res['processo'] == 'checkin'){?>
                    <h5 style="color:#4BCC72 ;">Checkin Realizado</h5>
                <?php } else if($res['processo'] == 'checkout'){?>
                    <h5 style="color:#4BCC72 ;">Checkout Realizado</h5>
                <?php } else if($res['processo'] == 'limpeza'){?>
                    <h5 style="color:#4BCC72 ;">Enviado Para Limpeza</h5>
                <?php } ?>
            </div>
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
      <?php if($res['processo'] == 'disponivel') { ?>
        <a href="alterar.php?id=<?php echo $res['id']; ?>&op=processo&processo=checkin&id_quarto=<?php echo $res['id_quarto']; ?>"  class="btn btn-primary">Fazer Checkin</a>
        <?php } else if($res['processo'] == 'checkin'){?>
        <a href="alterar.php?id=<?php echo $res['id']; ?>&op=processo&processo=checkout&id_quarto=<?php echo $res['id_quarto']; ?>"  class="btn btn-danger">Fazer Checkout</a>
        <?php } else if($res['processo'] == 'checkout'){?>
        <a href="alterar.php?id=<?php echo $res['id']; ?>&op=processo&processo=limpeza&id_quarto=<?php echo $res['id_quarto']; ?>"  class="btn btn-dark">Enviar Quarto Para A Limpeza</a>
        <?php } ?>         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>



<? } ?>

<?php include('footer.php'); ?>