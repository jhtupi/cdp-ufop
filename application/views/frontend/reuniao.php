<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                </h1>

                <?php
                    foreach($reunioes as $reuniao) {
                ?>
                     <!-- Carrega a imagem caso houver-->
                    <h2>
                        <?php echo $reuniao->titulo ?>
                    </h2>
                    <br>
                    <?php 
                       if($reuniao->imagem == 1) { // Se houver imagem
                           $fotoreuniao = base_url("assets/frontend/img/reunioes/".md5($reuniao->id).".jpg");
                       } else {
                            $fotoreuniao= "assets/frontend/img/semFoto2.png"; 
                        }
                    ?>
                    <img class="img-responsive img-circle" src="<?php echo base_url($fotoreuniao) ?>" alt="">
                    <hr>
                    <p class="lead">
                        Data: <a> <?php echo $reuniao->data ?></a>
                        Horário: <a> <?php echo $reuniao->horario ?></a>
                        <br>
                        <?php 
                        foreach($comunidades as $comunidade) { ?>
                        Comunidade: <a href="<?php echo base_url('comunidade/'.$comunidade->id)?>">
                            <?php
                            if($reuniao->id_comunidade == $comunidade->id) {
                                echo $comunidade->tema;
                            }
                        }?></a>
                    </p>
                    <br>
                    <p class="">
                        <?php echo $reuniao->resumo ?>
                    </p>
                    <hr>
                    <p class="lead">
                        Comentários
                        <br>
                        A FAZER
                    </p>
                    
                        <img class="img-responsive" src="<?php echo $fotoreuniao ?>" alt="">
                        <hr>    
                    
                    
                <?php 
                }
                ?>

            </div>