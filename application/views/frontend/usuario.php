<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                </h1>

                <?php
                    foreach($usuarios as $usuario) {
                ?>
                     
                    <div class="col-md-4">
                        <?php 
                            // Verifica se o usuário tem ou não imagem
                            if($usuario->foto == 1) { 
                                $mostraFoto= "assets/frontend/img/usuarios/".md5($usuario->id).".jpg"; 
                            } else {
                                $mostraFoto= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <img class="img-responsive img-circle" src="<?php echo base_url($mostraFoto) ?>" alt="">
                    </div>
                <div class="col-md-8 ">
                    <h2>
                       <?php echo $usuario->nome ?>
                    </h2>
                    <h3>
                       DEPARTAMENTO
                    </h3>  
                    <hr>
                    <p><b>E-mail: </b><?php echo $usuario->email ?></p>
                    <p><b>Telefone: </b><?php echo $usuario->telefone ?></p>

                    <hr>
                </div>


                <?php
                    }
                ?>


            </div>