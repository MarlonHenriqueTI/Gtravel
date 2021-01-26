<?php include('header.php'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Cadastrar<span> Hospede</span></h2>
                    <h6 class="mb-0">Hospede</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Cadastrar Hospede</li>
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
                            <h4 class="card-title mb-0">Hospede</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="cadastrar.php">
                                <div class="form-group">
                                    <label class="form-label">Nome</label>
                                    <input class="form-control" type="text" name="nome" placeholder="Nome do hospede">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input class="form-control" type="email" name="email" placeholder="E-mail do hospede">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CPF</label>
                                    <input class="form-control" type="text" name="cpf" placeholder="CPF do cliente">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Telefone</label>
                                    <input class="form-control" type="text" name="telefone" placeholder="(XX) X XXXX-XXXX">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CEP</label>
                                    <input class="form-control" type="text" name="cep" placeholder="CEP">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Rua</label>
                                    <input class="form-control" type="text" name="rua" placeholder="Rua">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bairro</label>
                                    <input class="form-control" type="text" name="bairro" placeholder="bairro">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Numero</label>
                                            <input class="form-control" type="number" name="numero" placeholder="numero">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Cidade</label>
                                            <input class="form-control" type="text" name="cidade" placeholder="Cidade">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">UF</label>
                                            <input class="form-control" type="text" name="uf" placeholder="UF">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Complemento</label>
                                    <input class="form-control" type="text" name="complemento" placeholder="Complemento">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Idade</label>
                                    <input class="form-control" type="number" name="idade" placeholder="Idade">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sexo</label>
                                    <select name="sexo" class="form-control">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                        <option value="Outro">Outro</option>

                                    </select>
                                </div>
                                <input type="hidden" name="op" value="hospede">
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-pill">Cadastrar</button>
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