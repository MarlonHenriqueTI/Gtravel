<?php include('header.php'); 
$id_quarto = $_GET['id'];
$quarto = selecionarQuarto($conexao, $id_quarto);
$tipos = capturarTiposQuarto($hotelId, $userNameHsystem, $password);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Editar<span> Quarto</span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Editar Quarto</li>
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
                            <h4 class="card-title mb-0">Quarto</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="alterar.php">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nome / Numero</label>
                                            <input type="text" class="form-control" value="<?php echo $quarto['nome']; ?>" name="nome" placeholder="UH 102">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control">
                                                <option value="" disabled>Selecione o tipo de quarto</option>
                                                <option value="<?php echo $quarto['id_tipo']; ?>" selected><?php echo $quarto['tipo']; ?></option>
                                                <?php foreach($tipos['roomRate'] as $key){?>
                                                    <option value="<?php echo $key['@attributes']['id']; ?>"><?php echo $key['@attributes']['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capacidade</label>
                                            <input type="number" name="capacidade" value="<?php echo $quarto['capacidade']; ?>" class="form-control" placeholder="O numero de hospedes">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observação</label>
                                            <textarea name="obs" rows="10" class="form-control"><?php echo $quarto['obs']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="op" value="quarto">
                                <input type="hidden" name="id" value="<?php echo $quarto['id']; ?>">
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-pill">Editar Quarto</button>
                                    <a href="quartos.php" class="btn btn-secondary btn-block btn-pill">Voltar</a>
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