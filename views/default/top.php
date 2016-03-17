<?php
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST']);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de envio de emails</title>


    <!-- Custom styling plus plugins -->
    <link href="<?php echo BASE_URL; ?>/static/css/custom.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">


    <!-- Bootstrap core CSS -->

    <link href="<?php echo BASE_URL; ?>/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/css/global.css" rel="stylesheet">

    <link href="<?php echo BASE_URL; ?>/static/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo BASE_URL; ?>/static/css/custom.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo BASE_URL; ?>/static/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body class="nav-md pace-running">
<div class="pace pace-active">
    <div class="pace-progress" style="transform: translate3d(99.8065%, 0px, 0px);" data-progress-text="99%"
         data-progress="99">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>

<div class="container body">


    <div class="main_container">

        <div class="col-md-3 left_col">
            <div tabindex="5000" class="left_col scroll-view"
                 style="outline: invert; cursor: url(http://www.google.com/intl/en_ALL/mapfiles/openhand.cur), n-resize; overflow-x: hidden; overflow-y: hidden;">

                <div class="navbar nav_title" style="border: 0;">
                    <a class="site_title"><i class="fa fa-comment"></i> <span>Emails!</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- sidebar menu -->
                <div class="main_menu_side hidden-print main_menu" id="sidebar-menu">

                    <div class="menu_section">

                        <ul class="nav side-menu">
                            <li><a href="<?= BASE_URL ?>/views/dashboard.php"><i class="fa fa-home"></i> Início </a>
                            </li>
                            <li><a><i class="fa fa-table"></i> Emissores de email <span
                                        class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?= BASE_URL ?>/views/host/list.php">Listar</a>
                                    </li>
                                    <li><a href="<?= BASE_URL ?>/views/host/inserir.php">Cadastrar</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-envelope"></i> Emails <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none;">
                                    <li><a href="<?= BASE_URL ?>/views/email/cotacao/enviar.php">Cotação</a>
                                    </li>
                                    <li><a href="<?= BASE_URL ?>/views/email/boleto_atualizado/enviar.php">Boleto
                                            Atualizado</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>


                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 691px;">
            <div class="conteudo">
