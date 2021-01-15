<?php include('header.php'); ?>
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <div class="container-fluid p-0">
        <!-- login page start-->
        <div class="authentication-main">
            <div class="row">
                <div class="col-md-12">
                    <div class="auth-innerright">
                        <div class="authentication-box">
                            <div class="card-body p-0">
                                <div class="cont text-center pad-3">
                                    <img src="assets/images/logo.png" alt="logo" class="img-fluid mobile pad-3">
                                    <div>
                                        <form class="theme-form" method="POST" action="fazer-login.php">
                                            <h4>LOGIN</h4>
                                            <h6 class="desktop">Entre com seu Nome de usuário e sua senha</h6>
                                            <div class="form-group">
                                                <input class="form-control" type="text" required="" placeholder="Seu nome de usuário" name="usuario">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="password" required="" placeholder="Sua senha" name="senha">
                                            </div>
                                            <div class="checkbox p-0">
                                                <input id="checkbox1" type="checkbox">
                                                <label for="checkbox1">Lembrar de mim</label>
                                            </div>
                                            <div class="form-group form-row mt-3 mb-0">
                                                <button class="btn btn-primary btn-block" type="submit">ENTRAR</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="sub-cont">
                                        <div class="img">
                                            <div class="img__text m--up">
                                                <img src="assets/images/logo.png" alt="logo" class="img-fluid">
                                                <h2>Bem vindo!</h2>
                                                <p>Entre em um mundo de possibilidades!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login page end-->
    </div>
</div>
<?php include('footer.php'); ?>