<?php include('header.php');

$administradores = selecionarTodosAdmin($conexao);

?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Todos <span>Usuarios</span></h2>
                    <h6 class="mb-0">Administradores</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item">Usuários </li>
                        <li class="breadcrumb-item active">Administradores</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <?php if (empty($administradores)) {
                echo "<h3>Nenhum administrador cadastrado no sistema</h3>";
            } else {
                foreach ($administradores as $adm) {
                    $i = rand(1, 6);
            ?>
                    <div class="col-md-6 col-lg-6 col-xl-4 box-col-6 xl-50">
                        <div class="card custom-card">
                            <?php if ($i == 1) { ?>
                                <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/2.jpg" alt=""></div>
                            <?php } else if ($i == 2) { ?>
                                <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/1.jpg" alt=""></div>
                            <?php } else if ($i == 3) { ?>
                                <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/3.jpg" alt=""></div>
                            <?php } else if ($i == 4) { ?>
                                <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/7.jpg" alt=""></div>
                            <?php } else if ($i == 5) { ?>
                                <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/5.jpg" alt=""></div>
                            <?php } else if ($i == 6) { ?>
                                <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/6.jpg" alt=""></div>

                            <?php }
                            if (empty($adm['foto'])) { ?>
                                <div class="card-profile"><img class="rounded-circle" src="../assets/images/user/7.jpg" alt=""></div>
                            <?php } else { ?>
                                <div class="card-profile"><img class="rounded-circle" src="../<?php echo $adm['foto']; ?>" alt=""></div>

                            <?php } ?>
                            <div class="text-center profile-details">
                                <h4><?php echo $adm['nome']; ?></h4>
                                <h6><?php echo $adm['username']; ?></h6>
                            </div>
                            <div class="card-footer row">
                                <?php if ($id != $adm['id']) { ?>
                                    <div class="col-4 col-sm-4">
                                        <a href="single-admin.php?id=<?php echo $adm['id']; ?>" class="btn btn-outline-primary">Ver Usuário</a>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <?php if ($adm['id'] == 1) { ?>
                                            <button class="btn btn-outline-warning">Não editavel</button>
                                        <?php } else { ?>
                                            <a href="editar-admin.php?id=<?php echo $adm['id']; ?>" class="btn btn-outline-warning">Editar Usuário</a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <a href="#" class="btn btn-outline-danger" onclick="deletar(<?php echo $adm['id']; ?>, 'admin')">Excluir Usuário</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 col-sm-12">
                                        <a href="single-admin.php?id=<?php echo $adm['id']; ?>">Ir para o meu perfil</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>







        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>



<?php include('footer.php'); ?>