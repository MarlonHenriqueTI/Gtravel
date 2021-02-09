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
                      <form class="theme-form" method="POST" action="alterar.php">
                        <div class="row mb-2">
                        <?php if(empty($foto)){ ?>
                          <div class="col-auto"><a href="#"  data-toggle="modal" data-target="#trocarFoto"><img class="img-70 rounded-circle" alt="" src="../assets/images/user/7.jpg"></a></div>
                        <?php }else{ ?>
                          <div class="col-auto"><a href="#"  data-toggle="modal" data-target="#trocarFoto"><img class="img-70 rounded-circle" alt="" src="../<?php echo $foto; ?>"></a></div>
                        <?php } ?>
                          
                          <div class="col">
                            <h3 class="mb-1"><?php echo $nome; ?></h3>
                            <p class="mb-4"><?php echo $username; ?></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Nome</label>
                          <input class="form-control" type="text" name="nome" placeholder="<?php echo $nome; ?>" value="<?php echo $nome; ?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">E-mail</label>
                          <input class="form-control" type="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Senha</label>
                          <input class="form-control" type="password" placeholder="Sua senha" name="senha">
                          <small>Deixe em branco se não quiser alterar sua senha</small>
                        </div>
                        <input type="hidden" name="op" value="adm">
                        <div class="form-footer">
                          <button class="btn btn-primary btn-block btn-pill">Salvar</button>
                        </div>
                      </form>

                      <form class="theme-form" method="POST" action="alterar.php" style="margin-top: 20px;">
                        <div class="row mb-2">
                          <div class="col">
                            <h3 class="mb-1">Integração Hsystem</h3>
                            <p class="mb-4">Preencha os dados da sua conta na HSYSTEM para integrar</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">ID do hotel</label>
                          <input class="form-control" type="text" name="hotelId" placeholder="<?php echo $hotelId; ?>" value="<?php echo $hotelId; ?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Username</label>
                          <input class="form-control" type="text" name="userName" placeholder="<?php echo $userNameHsystem; ?>" value="<?php echo $userNameHsystem; ?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Senha</label>
                          <input class="form-control" type="password" placeholder="<?php echo $password; ?>" name="password"  value="<?php echo $password; ?>">
                        </div>
                        <input type="hidden" name="op" value="hsystem">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
<div class="modal fade" id="trocarFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar sua foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../upload.php" enctype="multipart/form-data" method="POST">
          <div class="form-group">  
            <label>Envie uma nova foto</label>
            <input type="file" class="form-control" required name="arquivo" accept="image/*">
          </div>
          <input type="hidden" name="id" value="<?php  echo $id; ?>">
          <input type="hidden" name="op" value="admin">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar Nova Foto</button>
      </div>
        </form>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>