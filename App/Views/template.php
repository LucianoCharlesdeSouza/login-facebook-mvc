<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
        <title>Login-Facebook | MVC </title>
        <link href="<?= BASE; ?>App/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= BASE; ?>App/assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?= BASE; ?>App/assets/css/template.css" rel="stylesheet">

        <script src="<?= BASE; ?>App/assets/js/jquery.js"></script>
        <script src="<?= BASE; ?>App/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            var BASE = '<?php echo BASE; ?>';
        </script>
        <script src="<?= BASE; ?>App/assets/js/ajax.js"></script>
    </head>
    <body>
    <!--Box de Alerta-->
    <div class="boxerror alerta ">
        <h4><i class="icon icones "></i><span class="titulo"></span></h4>
        <div class="result"></div>
    </div>
    <!--Fim Box Alerta-->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a target="_blank" href="#" class="navbar-brand">MEU MVC</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">HOME</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">DropDown
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Link 2</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-user"></span>
                            <strong><?php echo $_SESSION['nome'];?></strong>
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <img class="icon-size" src="
                                                <?php
                                                if($_SESSION['picture'] == null){
                                                    echo BASE."App/assets/img/no_avatar.jpg";
                                                }
                                                echo $_SESSION['picture'];
                                                ?>">
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="text-left"><strong><?php echo $_SESSION['nome'];?></strong></p>
                                            <p class="text-left small"><?php echo $_SESSION['email'];?></p>
                                            <p class="text-left">
                                                <a href="#" class="btn btn-primary">Atualizar Perfil</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="<?php echo BASE;?>login/logout" class="btn btn-danger btn-block">Logout</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>

        <div class="clearfix"></div>
        <div class="footer">
            <h1></h1>
        </div>

    </body>
</html>
