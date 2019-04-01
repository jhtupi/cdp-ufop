<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                    
                </h1>

                <br>
 
                <div class="col-md-12 row">

                    <?php
                    foreach($autores as $autor) {
                    ?>
                    <div class="col-md-4 col-xs-6">
                        <?php 
                            // Verifica se o usuário tem ou não imagem
                            if($autor->img == 1) { 
                                $mostraImg= "assets/frontend/img/usuarios/".md5($autor->id).".jpg"; 
                            } else {
                                $mostraImg= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <img class="img-responsive img-circle" src="<?php echo base_url($mostraImg) ?>" alt="">
                         <h4 class="text-center">
                            <a href="<?php echo base_url('usuario/'.$autor->id.'/'.limpar($autor->nome)) ?>"><?php echo $autor->nome ?></a>
                        </h4> 
                    </div>

                    <?php
                        }
                    ?>
                    
                </div>


            </div>