<?php include('header.php'); 

$dados = selecionarTodosHospedes($conexao, $id);
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
                                                    <td><a href="#"  data-toggle="modal" data-target="<?php echo '#ver'.$key['id']; ?>"><?php echo $key['nome']; ?></a></td>
                                                    <td><?php echo $key['cpf']; ?></td>
                                                    <td><?php echo $key['email']; ?></td>
                                                    <td><?php echo $key['telefone']; ?></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#acoes'.$key['id']; ?>"><i class="fas fa-id-card-alt"></i></a></td>
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

<?php foreach($dados as $key) { ?>
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
      <h4 style="color:#4BCC72 ;">Histórico de reservas</h4>
        <?php $reserva = selecionarReservasCliente($conexao, $key['id']); ?>
        <div class="row">
        <?php foreach($reserva as $res){ 
            $quarto = selecionarQuarto($conexao, $res['id_quarto']);
            ?>
            <hr style="border: solid 1px #234567;width: 100%;">
            <div class="col-12">
                <h5>Período: <span><?php echo "De ".date('d/m/Y',strtotime($res['checkin']))." até ".date('d/m/Y',strtotime($res['checkout'])); ?></span></h5>
            </div>
            <div class="col-6">
                <h5>Valor: <span><?php echo "R$".$res['valor_total']; ?></span></h5>
            </div>
            <div class="col-6">
                <h5>Quarto: <span><?php echo $quarto['nome']; ?></span></h5>
            </div>
        <?php } ?>
        <hr style="border: solid 1px #234567;width: 100%;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo 'acoes'.$key['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
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
        <a href="editar-hospede.php?id=<?php echo $key['id'];?>" class="btn btn-primary">Editar Cliente</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deletar(<?php echo $key['id'];?>, 'hospede')">Excluir Cliente</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<? } ?>

<?php include('footer.php'); ?>