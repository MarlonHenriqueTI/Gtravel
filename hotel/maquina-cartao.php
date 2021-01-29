<?php include('header.php');

$dados = selecionarTodosHospedes($conexao);
?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Maquinas de <span>Cartão </span></h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="pe-7s-home"></i></a></li>
                        <li class="breadcrumb-item active">Maquinas de cartão</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
    
    </div>
    <!-- Container-fluid Ends-->
</div>

<?php include('footer.php'); ?>