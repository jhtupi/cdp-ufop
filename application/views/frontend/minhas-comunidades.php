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
                        <a href="<?php echo base_url('comunidade/'.$comunidade->id)?>"> <?php echo $comunidade->tema ?></a>
                    </h2>
                    <p class="lead">
                        criada por <a href="<?php echo base_url('usuario/'.$comunidade->id_usuario)?>"><?php echo $comunidade->nome; ?></a>
                    </p>
                    <p> <b> Criada em:</b> <?php echo postadoem($comunidade->data_criacao) ?></p>
                    <hr>


                    <a class="btn btn-primary" href="">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                <?php
                }
                ?>

            </div>