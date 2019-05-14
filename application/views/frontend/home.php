<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                    <small>> <?php echo $subtitulo ?></small>
                </h1>

                <!-- First Blog Post -->


                
                <?php
                    foreach($reunioes as $reuniao) {
                        
                ?>
                     <!-- Carrega a imagem caso houver-->
                    <h2>
                        <a href="<?php echo base_url('reuniao/'.$reuniao->id)?>"> <?php echo $reuniao->titulo ?></a>
                    </h2>
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
                    <hr>
                    <?php 
                        if($reuniao->imagem == 1) { // Se houver imagem
                            $fotoreuniao = base_url("assets/frontend/img/reunioes/".md5($reuniao->id).".jpg");
                    ?>
                        <img class="img-responsive" src="<?php echo $fotoreuniao ?>" alt="">
                        <hr>    
                    <?php 
                    }
                    ?>
                
                    <a class="btn btn-primary" href="">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>


                <?php
                    
                    }
                ?>

            </div>