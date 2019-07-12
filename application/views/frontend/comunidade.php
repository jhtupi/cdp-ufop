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

                    <h2>
                        <?php echo $comunidade->tema ?>
                    </h2>

                    
                    <br>
                    <p class="lead">
                        Data de criação: <a> <?php echo $comunidade->data_criacao ?></a>
                        <br>
                        <?php 
                        foreach($criador as $cr) { ?>
                            <?php
                            if($comunidade->id_usuario == $cr->id) {
                                ?>Criada por: <a href="<?php echo base_url('usuario/'.$cr->id)?>"><?php 
                                echo $cr->nome;
                            }
                        }
                         ?></a>
                     <?php  
                        if($comunidade->nps_medio != 101) { ?>
                    <br>NPS Médio: <a> <?php echo $comunidade->nps_medio ?></a>
                    <?php 
                        }
                     ?>
                    </p>
                    <br>
                    <p class="">
                        <?php echo $comunidade->descricao ?>
                    </p>
                    <hr>
                     <!-- Foreach comunidade -->   
                    <?php 
                    }
                    ?>

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
                                $mostraFoto= "assets/frontend/img/usuarios/".$membro->id.".jpg"; 
                            } else {
                                $mostraFoto= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <img class="img-responsive img-circle" style="width: 7vw; height: 7vw;" src="<?php echo base_url($mostraFoto) ?>" alt="">
                            <figcaption>
                                <h4 class="text-center">
                                    <a href="<?php echo base_url('usuario/'.$membro->id) ?>"><?php echo $membro->nome ?></a>
                                </h4> 
                            </figcaption>
                        </figure>
                         
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
                     
                    <h3>
                        <a href="<?php echo base_url('reuniao/'.$reuniao->id)?>"> <?php echo $reuniao->titulo ?></a>
                    </h3>
                    <p class="lead">
                        Data: <a> <?php echo $reuniao->data ?></a>
                        Horário: <a> <?php echo $reuniao->horario ?></a>
                        </p>
                    
                        <a class="btn btn-primary" href="<?php echo base_url('reuniao/'.$reuniao->id)?>">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                        <!-- Foreach reuniões -->   
                        <?php
                            
                            }

                    // Adiciona o paginador
                    echo "<div class= 'paginacao'>".$links_paginacao."</div>"
                        ?>
                
                </div>

            </div>
            