
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Busca no site</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <?php
                // Verifica se o usuário é membro da comunidade
                $ehParticipante = 0;
                    foreach($participantes as $participante) {
                        if ($this->session->userdata('userlogado')->id == $participante->id){
                            $ehParticipante = 1;
                        } else {}
                    }

                    if ($ehParticipante) {
                        foreach($comunidades as $comunidade) { 
                    ?>
                    <!-- Caso seja participante da reunião -->
                    <div class="well col-md-12">
                        <?php
                        //$reunioes as $reuniao;
                        $jaAconteceu = False; 
                        foreach($reunioes as $reuniao) {
                            $hoje = strtotime(date('Y-m-d'));
                            $dataReuniao = strtotime($reuniao->data);
                            if($hoje < $dataReuniao) { // Reunião já aconteceu
                                $jaAconteceu = True;
                            } else {}
                        } // foreach Reunioes

                         if ($jaAconteceu) {
                         ?>
                         <!-- Reunião já ocorreu -->
                        <form action="<?php echo base_url("reuniao/3") ?>">
                            <input class="btn btn-default col-md-12"  type="submit" value="Postar Material" />
                        </form>
                        <br><br>
                        <form action="">
                            <input class="btn btn-default col-md-12"  type="submit" value="Avaliar reunião" />
                        </form>

                        <?php } else {}
                         ?>
                         <!-- Reunião ainda não ocorreu -->
                        <form action="<?php echo base_url("reuniao/3") ?>">
                            <input class="btn btn-default col-md-12"  type="submit" value="Postar Material" />
                        </form>
                        <br><br>
                        <?php   // else $jaAconteceu
                        ?>

                    </div>
                        
                <?php   } // foreach Comunidade
                    ?>   
                    
                <?php } else {
                            foreach($comunidades as $comunidade) {
                            ?>
                <!-- Caso não seja participante -->
                <div class="well col-md-12">
                    <form action="<?php echo base_url("participar_comunidade"."/".$comunidade->id."/".$this->session->userdata('userlogado')->id) ?>">
                        <input class="btn btn-default col-md-12" type="submit" value="Participar da comunidade"/>
                    </form>   
                    <br><br>
                </div>  
                <?php
                        } // foreach Comunidade
                    } // else
                    
                ?>
