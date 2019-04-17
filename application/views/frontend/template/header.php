

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo base_url('home');  
                                        ?>">Comunidades</a> 
                    </li>
                    <li>
                        <a href="<?php echo base_url('usuarios');  
                                        ?>">Usuários</a> 
                    </li>
                    <li>
                        <a href="<?php echo base_url('sobrenos'); // baseurl chamando o controlador 'sobrenos' 
                                        ?>">Sobre Nós</a> 
                    </li>
                    <li>
                        <a href="<?php echo base_url('contato') ?>">Contato</a>
                    </li>
                    
                </ul>
              
                <!-- Menus da direita -->
                <ul class="nav navbar-nav" style= "float: right;">
                    <li class="dropdown" style= "float: right;">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Área do Usuário <span class="caret"></span></a>
                       <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admin') ?>">Painel Administrativo</a></li>
                        <li><a href="<?php echo base_url('home') ?>">Meu Perfil</a></li>
                        <li><a href="<?php echo base_url('home') ?>">Minhas Comunidades</a></li>
                        <li><a href="<?php echo base_url('home') ?>">Próximas Reuniões</a></li>
                        <li><a href="<?php echo base_url('home') ?>">Reuniões Passadas</a></li>
                        <li><a href="<?php echo base_url('usuarios/logout') ?>">Logout</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>