<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                    
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
                            <?php
                            if($reuniao->id_comunidade == $comunidade->id) {
                                ?> Comunidade: <a href="<?php echo base_url('comunidade/'.$comunidade->id)?>"> <?php
                                echo $comunidade->tema;
                            }
                        }?></a>
                    </p>
                    
                
                    <a class="btn btn-primary" href="<?php echo base_url('reuniao/'.$reuniao->id)?>">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>


                <?php
                    }
                    // Adiciona o paginador
                    echo "<div class= 'paginacao'>".$links_paginacao."</div>"

                ?>

            </div>