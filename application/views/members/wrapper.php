<div id="wrapper" class="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Opciones
                    </a>
                </li>
                <?php foreach($options->result() as $op){ ?>
                <li>
                    <a href="<?=base_url()?>members/panel/<?=$op->option_link?>"><?=$op->option_name?></a>
                </li>
                <?php } ?>
                <li><a href="<?=base_url()?>members/panel/addNews">AGREGAR NOTICIA</a></li>
                <li><a href="<?=base_url()?>members/panel/getNews">VER NOTICIAS</a></li>
               
              
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a style="margin-top:5px;" href="#menu-toggle" class="btn btn-md btn-success" id="menu-toggle">Ver/Ocultar Menú
                        <!--<img src="img/logo.png" height="55px">-->
                      </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav perfil">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><?=$user.' '?> <span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Perfil</a></li>
                                    <li><a href="#">Editar perfil</a></li>
                                    <li><a href="<?=base_url()?>members/panel/closeSesion">Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>          
                </div>

            </nav>
