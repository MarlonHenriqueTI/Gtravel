<?php include('header.php'); 

$dados = selecionarTodosHospedes($conexao);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Hospedes <span>Cadastrados </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active">Hospedes cadastrados</li>
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="dataTables_length" id="basic-1_length">
                                            <label>Mostrar
                                                <select name="mostrarDados" aria-controls="basic-1" class="">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="todos">todos</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="dataTables_length" id="basic-1_length">
                                            <label>
                                                <select name="ordenar" aria-controls="basic-1" class="">
                                                    <option value="10">Recentes</option>
                                                    <option value="25">Do primeiro cadastrado ao último</option>
                                                    <option value="50">ordem alfabetica</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div id="basic-1_filter" class="dataTables_filter">
                                            <label>
                                                <input type="search" class="" placeholder="" aria-controls="basic-1" name="busca">
                                                <button class="btn btn-primary" type="submit">Buscar Dados</button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th>id</th>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>E-mail</th>
                                            <th>Celular</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($dados)) {
                                            foreach ($dados as $key) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $key['id']; ?></td>
                                                    <td><a href="single-hospede.php?id=<?php echo $key['nome']; ?>"><?php echo $key['nome']; ?></a></td>
                                                    <td><?php echo $key['cpf']; ?></td>
                                                    <td><?php echo $key['email']; ?></td>
                                                    <td><?php echo $key['telefone']; ?></td>
                                                    <td><a href="#"><i class="fas fa-id-card-alt"></i></a></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <h4>Nenhum hotel cadastrado no sistema, <a href="cadastrar-hotel.php">Cadastre seu primeiro hotel agora</a></h4>
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

<?php include('footer.php'); ?>