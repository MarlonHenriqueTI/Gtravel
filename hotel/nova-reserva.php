<?php include('header.php'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Cadastrar<span> Reserva</span></h2>
                    <h6 class="mb-0">Nova Reserva</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active"> Cadastrar Reserva</li>
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
                            <h4 class="card-title mb-0">Reserva</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" method="POST" action="cadastrar.php">
                                <span class="titulo-form">HOSPEDE</span>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <input type="text" class="form-control" name="cpf_cnpj" required placeholder="CPF ou CNPJ do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input type="text" class="form-control" name="RG" required placeholder="RG do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" name="nome" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <input type="text" class="form-control" name="telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                                <span class="titulo-form">EMPRESA</span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <input type="text" class="form-control" name="cpf_cnpj_empresa">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="nome_empresa">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="titulo-form">Pagamento</label>
                                            <select name="pagamento" class="form-control">
                                                <option value="A vista">A vista</option>
                                                <option value="Credito">Credito</option>
                                                <option value="Debito">Debito</option>
                                                <option value="Deposito">Deposito</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="titulo-form">Check-In</label>
                                            <input type="datetime-local" class="form-control" name="checkin" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="titulo-form">Check-Out</label>
                                            <input type="datetime-local" class="form-control" name="checkout">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="titulo-form">UH</label>
                                            <select name="uh" class="form-control">
                                                <option value="Quarto 145">Quarto 145</option>
                                                <option value="Quarto 146">Quarto 146</option>
                                                <option value="Quarto 147">Quarto 147</option>
                                                <option value="Quarto 148">Quarto 148</option>
                                                <option value="Quarto 149">Quarto 149</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="op" value="reserva">
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