<?php include('header.php');

$dados = selecionarTodosQuartos($conexao);

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
      <?php foreach ($dados as $key) { ?>
        <div class="col-md-2 col-6">
          <a href="#">
            <div class="card">
              <div class="card-body apt">
                <div class="row">
                  <div class="col-8" style="padding-right: 0;">
                    <h5><?php echo $key['nome']; ?></h5>
                  </div>
                  <div class="col" style="padding-left: 0;">
                    <small><?php echo $key['capacidade']; ?> <i class="fas fa-user"></i></small>
                  </div>
                </div>

              </div>
              <?php if ($key['status'] == "Disponivel") { ?>
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
<?php include('footer.php'); ?>