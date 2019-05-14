<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                </h1>

                <?php
                    foreach($comunidades as $comunidade) {
                    
                ?>
                     <!-- Carrega a imagem caso houver-->
                    <h2>
                        <?php echo $comunidade->tema ?>
                    </h2>
                    <br>
                    <?php 
                       if($comunidade->imagem == 1) { // Se houver imagem
                           $fotocomunidade = base_url("assets/frontend/img/comunidades/".md5($comunidade->id).".jpg");
                       } else {
                            $fotocomunidade= "assets/frontend/img/semFoto2.png"; 
                        }
                    ?>
                    <img class="img-responsive img-circle" src="<?php echo base_url($fotocomunidade) ?>" alt="">
                    <hr>
                    <p class="lead">
                        Data de criação: <a> <?php echo $comunidade->data_criacao ?></a>
                        <br>
                        Criada por: <a href=""><?php echo 'CONFIGURAR' ?></a>
                        <br>
                        NPS Médio: <a> <?php echo 'configurar'?></a>
                    </p>
                    <br>
                    <p class="">
                        <?php echo $comunidade->descricao ?>
                    </p>
                    <hr>
                    <p class="lead">
                        Membros da comunidade
                        <br>
                        <?php
                    foreach($membros as $membro) {
                    ?>
                    <div class="col-md-4 col-xs-6">
                        <?php 
                            // Verifica se o usuário tem ou não imagem
                            if($membro->foto == 1) { 
                                $mostraFoto= "assets/frontend/img/usuarios/".md5($membro->id).".jpg"; 
                            } else {
                                $mostraFoto= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <img class="img-responsive img-circle" src="<?php echo base_url($mostraFoto) ?>" alt="">
                         <h4 class="text-center">
                            <a href="<?php echo base_url('usuario/'.$membro->id.'/'.limpar($membro->nome)) ?>"><?php echo $membro->nome ?></a>
                        </h4> 
                    </div>

                    <?php
                        }
                    ?>
                    </p>
                    <hr>
                    <p class="lead">
                        Reuniões já feitas
                        <br>
                        A FAZER
                    </p>
                    
                         
                    
                    
                <?php 
                }
                ?>

            </div>