<?php include('header.php');

$dados = selecionarTodosHospedes($conexao);
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
                                <h4>160 Reservas | 201 Hóspedes | 8 Grupos</h4>
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
                                                    <option value="" disabled>Filtrar por apto</option>
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

<?php include('footer.php'); ?>