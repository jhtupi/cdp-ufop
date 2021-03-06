<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                    
                </h1>

                <br>
                <div class="row">
                    <?php
                    foreach($usuarios as $usuario) {
                    ?>
 


                    <div class="col-md-4 col-xs-6">
                        <?php 
                            // Verifica se o usuário tem ou não imagem
                            if($usuario->foto == 1) { 
                                $mostraFoto= "assets/frontend/img/usuarios/".$usuario->id.".jpg"; 
                            } else {
                                $mostraFoto= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <figure>
                        <img class="img-responsive img-circle" style="width: 15vw; height: 15vw;" src="<?php echo base_url($mostraFoto) ?>" alt="">
                            <figcaption>
                                <h4 class="text-center"> 
                                    <a href="<?php echo base_url('usuario/'.$usuario->id) ?>"><?php echo $usuario->nome ?></a>
                                </h4> 
                            </figcaption>
                        </figure>
                    </div>
                    <?php
                        }
                        // Fechamento do foreach
                        ?>
                </div>
                    <div class="">
                      <?php  
                        echo "<div class= 'paginacao'>".$links_paginacao."</div>"
                    ?>
                    </div>


            </div>