<?php include('header.php'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Adicionar<span> Novo</span></h2>
                    <h6 class="mb-0">Administrador</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Adicionar Administrador</li>
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
                            <h4 class="card-title mb-0">Cadastre o novo administrador</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="cadastrar.php">
                                <div class="row mb-2">
                                    <div class="col-auto"><a href="#" data-toggle="modal" data-target="#aviso"><img class="img-70 rounded-circle" alt="" src="../assets/images/user/7.jpg"></a></div>

                                    <div class="col">
                                        <h3 class="mb-1">Ainda sem nome</h3>
                                        <p class="mb-4">Sem nome de usuário</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nome</label>
                                    <input class="form-control" type="text" name="nome" placeholder="O nome do novo administrador" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input class="form-control" type="email" name="email" placeholder="O e-mail do novo administrador" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nome de Usuário</label>
                                    <input class="form-control" type="text" name="username" placeholder="O username do novo administrador" required>
                                    <small>Usado para logar no sistema</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Senha</label>
                                    <input class="form-control" type="password" placeholder="Sua senha" name="senha" required value="senha aqui">
                                    <small>Anote a senha antes de salvar para não esquecer</small>
                                </div>
                                <input type="hidden" name="op" value="adm">
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-pill">Salvar</button>
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

<!-- Modal -->
<div class="modal fade" id="aviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ops...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Você não pode enviar uma foto para este usuário, isto é algo que só ele pode fazer!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>