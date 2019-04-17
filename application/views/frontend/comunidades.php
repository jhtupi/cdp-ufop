<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                    <small> <?php echo $subtitulo ?></small>
                </h1>

                <!-- First Blog Post -->


                
                <?php
                    foreach($comunidades as $comunidade) {
                ?>
                     
                    <h2>
                        <a href="<?php echo base_url('comunidades')?>"> <?php echo $comunidade->tema ?></a>
                    </h2>
                    <p class="lead">
                        criada por <a href=""><?php echo 'CONFIGURAR' ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo postadoem($comunidade->data_criacao) ?></p>
                    <hr>

                    <!-- Carrega a imagem caso houver-->
                    <?php 
                        if($comunidade->imagem == 1) { // Se houver imagem
                            $imgcomunidade = base_url("assets/frontend/img/comunidades/".md5($comunidade->id).".jpg");
                    ?>
                        <img class="img-responsive" src="<?php echo $imgcomunidade ?>" alt="">
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