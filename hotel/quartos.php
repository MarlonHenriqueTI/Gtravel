<?php include('header.php'); 

$ordem = $_GET['ordem'];

if($ordem == 'recentes'){
    $dados = selecionarTodosQuartosFiltro($conexao, 10, 'recentes', $id);
} else if($ordem == 'alfabetica'){
    $dados = selecionarTodosQuartosFiltro($conexao, 10, 'alfabetica', $id);
} else {
    $dados = selecionarTodosQuartosFiltro($conexao, 10, 'normal', $id);
    
}


?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Quartos <span>Cadastrados </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active">Quartos cadastrados</li>
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
                                                <select name="ordenar" aria-controls="basic-1" class="" onchange="attFiltro(this, 'ordem', 'quartos')">
                                                    <option value="">Ordenar por</option>
                                                    <option value="recentes">Recentes</option>
                                                    <option value="normal">Do primeiro cadastrado ao último</option>
                                                    <option value="alfabetica">ordem alfabetica</option>
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
                                            <th>Tipo</th>
                                            <th>Capacidade</th>
                                            <th>Status</th>
                                            <th>Observações</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($dados)) {
                                            foreach ($dados as $key) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $key['id']; ?></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#ver'.$key['id']; ?>"><?php echo $key['nome']; ?></a></td>
                                                    <td><?php echo $key['tipo']; ?></td>
                                                    <td><?php echo $key['capacidade']." hospedes"; ?></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#status'.$key['id']; ?>"><?php echo $key['status']; ?></a></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#obs'.$key['id']; ?>">Ver Observações</a></td>
                                                    <td><a href="#" data-toggle="modal" data-target="<?php echo '#acoes'.$key['id']; ?>"><i class="fas fa-id-card-alt"></i></a></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <h4>Nenhum quarto cadastrado no sistema, <a href="cadastrar-quarto.php">Cadastre seu primeiro hotel agora</a></h4>
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
<div class="modal fade" id="<?php echo 'obs'.$key['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Observações</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $key['obs']; ?>
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
                <h5>Status: <span><?php echo $key['status']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Nome/Numero: <span><?php echo $key['nome']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Tipo: <span><?php echo $key['tipo']; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Capacidade: <span><?php echo $key['capacidade'].' Hospedes'; ?></span></h5>
            </div>
            <div class="col-12">
                <h5>Referencia na HSystem: <span><?php echo $key['id_tipo']; ?></span></h5>
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
        <a href="editar-quarto.php?id=<?php echo $key['id'];?>" class="btn btn-primary">Editar Quarto</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deletar(<?php echo $key['id'];?>, 'apartamento')">Excluir Quarto</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="<?php echo 'status'.$key['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalObs" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Defina um novo status para o quarto <?php echo $key['nome']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="alterar.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label>Selecione um status</label>
            <select name="status" class="form-control">
                <option value="Disponivel">Disponivel</option>
                <option value="Ocupado">Ocupado</option>
                <option value="Limpeza">Limpeza</option>
                <option value="Manutenção">Manutenção</option>
            </select>
        </div>     
        <input type="hidden" name="id" value="<?php echo $key['id'];?>"> 
        <input type="hidden" name="op" value="disponibilidade"> 

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Alterar Status</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php } include('footer.php'); ?>