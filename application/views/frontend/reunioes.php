<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo;
                    $this->load->helper('date');
                    ?>
                    <small>> <?php echo $subtitulo ?></small>
                </h1>

                <!-- First Blog Post -->


                
                <?php
                    foreach($reunioes as $reuniao) {
                    

                    // Data e horário não passaram ainda
                    if(date_parse($reuniao->data.' '.$reuniao->horario) > date_parse(date('Y-m-d h:m:s', now('America/Sao_Paulo'))) && $flag ==0){
                        
                ?>  
                        
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
                        
                    
                        <a class="btn btn-primary" href="">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                <?php
                        } // if data e horários
                        else if(date_parse($reuniao->data.' '.$reuniao->horario) < date_parse(date('Y-m-d h:m:s', now('America/Sao_Paulo'))) && $flag ==1) {
                ?>

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
                        
                    
                        <a class="btn btn-primary" href="">Saiba mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>



                <?php
                    } // else flag ==1 
              }   
                ?>

            </div>