<?php include('header.php'); ?>

<div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Editar<span> Perfil</span></h2>
                  <h6 class="mb-0">Administrador</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">     
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item active"> Meu Perfil</li>
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
                      <h4 class="card-title mb-0">Meu Perfil</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <form class="theme-form">
                        <div class="row mb-2">
                          <div class="col-auto"><a href="#"><img class="img-70 rounded-circle" alt="" src="../assets/images/user/7.jpg"></a></div>
                          <div class="col">
                            <h3 class="mb-1"><?php echo $nome; ?></h3>
                            <p class="mb-4"><?php echo $username; ?></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Nome</label>
                          <input class="form-control" type="text" placeholder="<?php echo $nome; ?>" value="<?php echo $nome; ?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">E-mail</label>
                          <input class="form-control" type="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Senha</label>
                          <input class="form-control" type="password" placeholder="Sua senha">
                          <small>Deixe em branco se não quiser alterar sua senha</small>
                        </div>
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

<?php include('footer.php'); ?>