<?php include('header.php');

$dados = selecionarTodosQuartos($conexao, $id);
$hoje = date('Y-m-d');
$reservas = selecionarTodasReservas($conexao, $id);
foreach($reservas as $key){
  if((strtotime($hoje) >= strtotime($key['checkin'])) && (strtotime($hoje) <= strtotime($key['checkout']))){
    setDisponibilidade($key['id_quarto'], $conexao, 'Ocupado');
  }
}
?>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Bem vindo ao <span>GTravel</span></h2>
          <h6 class="mb-0">Painel do administrador de hotel</h6>
        </div>
        <div class="col-lg-6 breadcrumb-right">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
            <li class="breadcrumb-item active">Início</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <?php foreach ($dados as $key) { 
        
        ?>
        <div class="col-md-2 col-6">
          <a href="#"  data-toggle="modal" data-target="<?php echo '#acoes'.$key['id']; ?>">
            <div class="card">
              <div class="card-body apt <?php if($key['status'] == 'Ocupado'){ echo "apto-ocupado"; } ?>">
                <div class="row">
                  <div class="col-8" style="padding-right: 0;">
                    <h5><?php echo $key['nome']; ?></h5>
                  </div>
                  <div class="col" style="padding-left: 0;">
                    <small><?php echo $key['capacidade']; ?> <i class="fas fa-user"></i></small>
                  </div>
                  <?php if ($key['status'] == "Ocupado") { ?>
                      <div class="col-12 menor"  style="padding-top: 10px;">
                        <?php 
                          $reserva = selecionarReservaQuartoHoje($conexao, $key['id']); 
                          $frase = explode(" ", $reserva['nome']);
                          echo $frase[0];
                        ?>
                      </div>
                      <div class="col-12 menor">
                        <small>Falta Pagar: <?php echo "R$".($reserva['valor_total']-$reserva['pre_pagamento']-$reserva['valor_descontos']); ?></small>
                      </div>
                  <?php } ?>
                </div>

              </div>
              <?php if($key['bloqueado']){ ?>
                <div class="card-footer bloqueado"></div>
              <?php } else if ($key['status'] == "Disponivel") { ?>
                <div class="card-footer disponivel"></div>
              <?php } else if ($key['status'] == "Ocupado") { ?>
                <div class="card-footer ocupado"></div>
              <?php } else if ($key['status'] == "Limpeza") { ?>
                <div class="card-footer limpeza"></div>
              <?php } else if ($key['status'] == "Manutenção") { ?>
                <div class="card-footer manutencao"></div>
              <?php } ?>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>

<?php foreach($dados as $key) { ?>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'acoes'.$key['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $key['nome']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if(!$key['bloqueado']){
          $reserva = selecionarReservaQuartoHoje($conexao, $key['id']);
          $futuras = selecionarReservasFuturasQuarto($conexao, $key['id']);
          if($reserva['processo'] == 'checkin'){?>
          <div class="row">
            <div class="col-12">
                <h5>Hospede: <span><?php echo $reserva['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Valor Total: <span><?php echo "R$".$reserva['valor_total']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Ainda Deve Ser Pago: <span><?php echo "R$".($reserva['valor_total']-$reserva['pre_pagamento']-$reserva['valor_descontos']); ?></span></h5>
            </div>
            <hr style="border: solid #DEE2E6 1px; width: 100%;">
            <div class="col-12">
                <h5 style="color:#4BCC72 ; padding-top: 10px;">RESERVAS FUTURAS PARA ESTE QUARTO</h5>
            </div>
            <?php foreach($futuras as $fut){?>
            <hr style="border: solid #DEE2E6 1px; width: 100%;">
              <div class="col-12">
                <h5>Hospede: <span><?php echo $fut['nome']; ?></span></h5>
              </div>
              <div class="col-6">
                  <h5>Valor Total: <span><?php echo "R$".$fut['valor_total']; ?></span></h5>
              </div>
              <div class="col-6">
                  <h5>Checkin: <span><?php echo date('d/m/Y', strtotime($fut['checkin'])); ?></span></h5>
              </div>
            <? } ?>
          </div>
        <?php } else {?>
          O que você deseja?
        <?php }} else {?>
          Este quarto está bloqueado
        <?php } ?>
      </div>
      <div class="modal-footer">
        <div class="row">
        <?php if(!$key['bloqueado']){?>
          <div class="col">
           <a href="nova-reserva.php?id=<?php echo $key['id'];?>" class="btn btn-primary">Criar Reserva</a>
          </div>
          <?php } ?>
          <div class="col">
          <?php if(!$key['bloqueado']){?>
            <a href="alterar.php?id=<?php echo $key['id']; ?>&op=bloquear" class="btn btn-danger">Bloquear Quarto</a>
            <?php } else {?>
              <a href="alterar.php?id=<?php echo $key['id']; ?>&op=desbloquear" class="btn btn-danger">Desbloquear Quarto</a>
            <?php } ?>
          </div>
          <?php if(!$key['bloqueado']){?>
          <div class="col">
            <a href="reserva-quarto-hoje.php?id=<?php echo $key['id']; ?>" class="btn btn-warning">Ver Reserva De Hoje</a>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<? } ?>

<?php include('footer.php'); ?>