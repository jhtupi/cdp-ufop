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
                        <?php 
                        foreach($membros as $membro) { ?>
                            <?php
                            if($comunidade->id_usuario == $membro->id) {
                                ?>Criada por: <a href="<?php echo base_url('usuario/'.$membro->id.'/'.limpar($membro->nome))?>"><?php 
                                echo $membro->nome;
                            }
                        }
                         ?></a>
                        <br>
                        NPS Médio: <a> <?php echo 'configurar'?></a>
                    </p>
                    <br>
                    <p class="">
                        <?php echo $comunidade->descricao ?>
                    </p>
                    <hr>

                                                    <!-- Membros da Comunidade -->
                    <h2>Membros da comunidade</h2>
                        
                    <br>
                    <?php
                    foreach($membros as $membro) {
                    ?>
                    <div class="col-md-2 col-xs-3">
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

                    <!-- Foreach usuários -->   
                    <?php
                        }
                    ?>

                                                    <!-- Reuniões da Comunidade -->
                    
                    <div class="col-md-12 col-xs-12">
                    <hr>
                    <h2>Reuniões da comunidade</h2>
                    <?php
                    foreach($reunioes as $reuniao) {
                    ?>
                     <!-- Carrega a imagem caso houver-->
                    <h3>
                        <a href="<?php echo base_url('reuniao/'.$reuniao->id)?>"> <?php echo $reuniao->titulo ?></a>
                    </h3>
                    <p class="lead">
                        Data: <a> <?php echo $reuniao->data ?></a>
                        Horário: <a> <?php echo $reuniao->horario ?></a>
                        </p>
                        <?php 
                            if($reuniao->imagem == 1) { // Se houver imagem
                                $fotoreuniao = base_url("assets/frontend/img/reunioes/".md5($reuniao->id).".jpg");
                        ?>
                            <img class="img-responsive" src="<?php echo $fotoreuniao ?>" alt="">
                                
                        <?php 
                        }
                        ?>
                    
                        <a class="btn btn-primary" href="">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                        <!-- Foreach reuniões -->   
                        <?php
                            
                            }
                        ?>
                 <!-- Foreach comunidade -->   
                <?php 
                }
                ?>
                </div>
            </div>