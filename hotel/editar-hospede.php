<?php include('header.php'); 
$id_cliente = $_GET['id'];
$hospede = selecionarHospede($conexao, $id_cliente);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Editar<span> Hospede</span></h2>
                    <h6 class="mb-0">Hospede</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Editar Hospede</li>
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
                            <h4 class="card-title mb-0">Editar Hospede</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="alterar.php">
                                <div class="form-group">
                                    <label class="form-label">Nome</label>
                                    <input class="form-control" type="text" name="nome" placeholder="Nome do hospede" value="<?php echo $hospede['nome']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input class="form-control" type="email" name="email" placeholder="E-mail do hospede" value="<?php echo $hospede['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CPF</label>
                                    <input class="form-control" type="text" name="cpf" placeholder="CPF do cliente" value="<?php echo $hospede['cpf']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Telefone</label>
                                    <input class="form-control" type="text" name="telefone" placeholder="(XX) X XXXX-XXXX" value="<?php echo $hospede['telefone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CEP</label>
                                    <input class="form-control" type="text" name="cep" placeholder="CEP" value="<?php echo $hospede['cep']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Rua</label>
                                    <input class="form-control" type="text" name="rua" placeholder="Rua" value="<?php echo $hospede['rua']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bairro</label>
                                    <input class="form-control" type="text" name="bairro" placeholder="bairro" value="<?php echo $hospede['bairro']; ?>">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Numero</label>
                                            <input class="form-control" type="number" name="numero" placeholder="numero" value="<?php echo $hospede['numero']; ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Cidade</label>
                                            <input class="form-control" type="text" value="<?php echo $hospede['cidade']; ?>" name="cidade" placeholder="Cidade">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">UF</label>
                                            <input class="form-control" type="text" value="<?php echo $hospede['uf']; ?>" name="uf" placeholder="UF">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Complemento</label>
                                    <input class="form-control" type="text" name="complemento" placeholder="Complemento" value="<?php echo $hospede['complemento']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nascimento</label>
                                    <input class="form-control" type="date" name="idade" placeholder="Idade" value="<?php echo $hospede['idade']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sexo</label>
                                    <select name="sexo" class="form-control">
                                    <option value="<?php echo $hospede['sexo']; ?>" seleccted><?php echo $hospede['sexo']; ?></option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                        <option value="Outro">Outro</option>

                                    </select>
                                </div>
                                <input type="hidden" name="op" value="hospede">
                                <input type="hidden" name="id" value="<?php echo $hospede['id']; ?>">
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-pill">Cadastrar</button>
                                    <a href="hospedes.php" class="btn btn-secondary btn-block btn-pill">Voltar</a>
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