<?php
session_start();
if (!isset($_SESSION["user_portal"])) {
    header("location:../index.php");
}
include('../db/functions.php');


$email = $_SESSION["user_portal"];

// atribui a variável $paginaLink apenas o nome da página
$paginaLink = basename($_SERVER['SCRIPT_NAME']);

include('../db/conecta-db.php');
$consulta = "SELECT * from hotel where email = '$email'";
$query = mysqli_query($conexao, $consulta);
if (!$query) {
    echo "<script>Falha ao capturar email</script>";
    die();
}

while ($administrador = mysqli_fetch_array($query)) {
    $username = $administrador["username"];
    $nome = $administrador["nome_responsavel"];
    $id = $administrador["id"];
    $foto = $administrador["foto"];
}

$hsystem = selecionarHsystem($conexao, $id);
$hotelId = $hsystem['hotelId'];
$userNameHsystem = $hsystem['userName'];
$password = $hsystem['password'];
$reservasHsystem = capturarReservasHsystem($hotelId, $userNameHsystem, $password);
$reservas = selecionarTodasReservas($conexao, $id);
foreach( $reservasHsystem['reservation'] as $res){
    $i = 0;
    foreach($reservas as $key){
        if($key['id'] == $res['id']){
            $i = 1;
        }
    }
    if($i == 0){
        $tipos = capturarTiposQuarto($hotelId, $userNameHsystem, $password);
        foreach($tipos['roomRate'] as $quarto){
             if($res['rooms']['room']['roomTypeId'] == $quarto['@attributes']['id']) {
                 $tipoQuarto = utf8_encode($quarto['@attributes']['name']);
             }
        }
        $quartoCadastrado = selecionarQuartoTipo($conexao, $tipoQuarto, $res['rooms']['room']['adults']);
        if(empty($res['payment']['prePaymentValue'])){
            $pre = '0';
        } else {
            $pre = $res['payment']['prePaymentValue'];
        }

        if(empty($res['rooms']['room']['addons']['addon']['totalValue'])){
            $addon = 0;
        } else {
            $addon = $res['rooms']['room']['addons']['addon']['totalValue'];
        }
        cadastrarReservaHSystem($conexao, $res['id'], $res['guest']['firstName'], $res['guest']['phone'], $res['guest']['email'], $res['paymentType'], $res['rooms']['room']['arrivalDate'], $res['rooms']['room']['departureDate'], $quartoCadastrado['id'], $res['locatorId'], $id, $res['status'], $res['rooms']['room']['adults'], $res['createDateTime'],floatval($res['totalValue']), $addon, $pre);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- Mirrored from admin.pixelstrap.com/poco/ltr/sample-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Jan 2021 16:45:54 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gtravel é um sistema de gerenciamento de alugueis">
    <meta name="keywords" content="Gtravel, aluguel, gerenciamento de hoteis, quartos de hoteis, aluguel de temporada">
    <meta name="author" content="Marlon Henrique">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <title>Gtravel - <?php echo $username; ?></title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <!-- Flag icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" />
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pe7-icon@1.0.4/dist/dist/pe-icon-7-stroke.min.css">
    <!-- Plugins css Ends-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
    
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="typewriter">
            <h1><?php echo $nome; ?> bem vindo ao Gtravel...</h1>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right">
                <div class="main-header-left text-center">
                    <div class="logo-wrapper"><a href="index.php"><img src="../assets/images/logo.png" alt="logo" style="width: 175px; max-width:100%;"></a></div>
                </div>
                <div class="mobile-sidebar">
                    <div class="media-body text-right switch-sm">
                        <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
                    </div>
                </div>
                <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"> </i></div>
                <div class="nav-right col pull-right right-menu">
                    <ul class="nav-menus">
                        <li class="onhover-dropdown"><img class="img-fluid img-shadow-warning" src="../assets/images/dashboard/notification.png" alt="">
                            <ul class="onhover-show-div notification-dropdown">
                                <li class="gradient-primary">
                                    <h5 class="f-w-700">Notificações</h5><span>Você possuí 0 notificações não lidas</span>
                                </li>
                                <li class="bg-light txt-dark"><a href="#">Todas </a> notificações</li>
                            </ul>
                        </li>
                        <li class="onhover-dropdown"> <span class="media user-header">
                        <?php if(empty($foto)){?>
                            <img class="img-fluid img-70 rounded-circle" src="../assets/images/user/7.jpg" alt="imagem usuario">
                        <?php } else {?>
                            <img class="img-fluid img-70 rounded-circle" src="../<?php echo $foto; ?>" alt="imagem usuario">
                        <?php }?>
                        </span>
                            <ul class="onhover-show-div profile-dropdown">
                                <li class="gradient-primary">
                                    <h5 class="f-w-600 mb-0"><?php echo $nome ?></h5><span>Administrador de hotel</span>
                                </li>
                                <li><a href="perfil.php" class="link-menu"><i data-feather="user"> </i>Perfil</a></li>
                                <li><a href="../logout.php" class="link-menu"><i data-feather="minus-circle"> </i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
                </div>
                <script id="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"><?php echo $nome; ?></div>
            </div>
            </div>
          </script>
                <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
              <!-- Page Body Start-->
      <div class="page-body-wrapper">
       <?php include ('sidebar.php'); ?>