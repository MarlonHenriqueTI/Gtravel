<?php include('header.php');
$id_user = $_GET['id'];
$dados = selecionarAdmin($conexao, $id_user);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Administrador<span> <?php echo $dados['nome']; ?></span></h2>
                    <h6 class="mb-0"><?php echo $dados['email']; ?></h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item">Administradores</li>
                        <li class="breadcrumb-item active"><?php echo $dados['nome']; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                    <div class="card hovercard text-center">
                        <div class="cardheader"></div>
                        <div class="user-image">
                            <?php if (empty($dados['foto'])) { ?>
                                <div class="avatar"><img alt="" src="../assets/images/user/7.jpg"></div>
                            <?php } else { ?>
                                <div class="avatar"><img alt="" src="../<?php echo $dados['foto']; ?>"></div>
                            <?php } ?>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="ttl-info text-center">
                                                <h6><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;Cadastrado desde</h6><span><?php echo date('d/m/Y', strtotime($dados['data'])); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                    <div class="user-designation">
                                        <div class="title"><a target="_blank" href="#"><?php echo $dados['nome']; ?></a></div>
                                        <div class="desc mt-2">Administrador</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="ttl-info text-center">
                                                <h6><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;E-mail</h6><span><?php echo $dados['email']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <button class="btn btn-danger" onclick="javascript:history.back()">Voltar</button>
                    </div>
                </div>
                <!-- user profile first-style end-->
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

<?php include('footer.php'); ?>