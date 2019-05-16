
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
                    // Verifica se a reunião já aconteceu
                    $jaAconteceu = False; 
                    foreach($reunioes as $reuniao) {
                        $hoje = strtotime(date('Y-m-d'));
                        $dataReuniao = strtotime($reuniao->data);
                        if($hoje < $dataReuniao) { // Reunião já aconteceu
                            $jaAconteceu = True;
                        } else {}
                    } // foreach Reunioes

                    // Verifica se o usuário é membro da reunião
                        $ehParticipante = 0;
                        foreach($participantes as $participante) {
                            if ($this->session->userdata('userlogado')->id == $participante->id){
                                $ehParticipante = 1;
                            } else {}
                        }

                     if ($jaAconteceu) {

                        if ($ehParticipante) {
                            foreach($comunidades as $comunidade) { 
                        ?>
                    
                    <div class="well col-md-12">
                        
                         <!-- Reunião já ocorreu | Usuário é participante -->
                        <form action="<?php echo base_url("reuniao/3") ?>">
                            <input class="btn btn-default col-md-12"  type="submit" value="Postar Material" />
                        </form>
                        <br><br>
                        <form action="">
                            <input class="btn btn-default col-md-12"  type="submit" value="Avaliar reunião" />
                        </form>

                    </div>
                        <?php } // foreach Comunidade
                        } else {} // Reunião já ocorreu | Usuário não é participante

                        } // if $jaAconteceu                         
                        else { 
                            foreach($reunioes as $reuniao) {
                                if ($ehParticipante) {
                         ?>

                         <!-- Reunião não ocorreu | Usuário é participante -->
                        <div class="well col-md-12">
                        <form action="<?php echo base_url("sair_reuniao"."/".$reuniao->id."/".$this->session->userdata('userlogado')->id) ?>">
                        <input class="btn btn-default col-md-12" type="submit" value="Sair da reunião"/>
                        </form>   
                        <br><br>
                        </div>  
                        <?php   } // if $ehParticipante
                                else {
                        ?>
                        <!-- Reunião não ocorreu | Usuário não é participante -->
                        <div class="well col-md-12">
                            <form action="<?php echo base_url("participar_reuniao"."/".$reuniao->id."/".$this->session->userdata('userlogado')->id) ?>">
                                <input class="btn btn-default col-md-12" type="submit" value="Participar da reunião"/>
                                </form>   
                                <br><br>
                        </div>  
                        <?php
                                } // else $ehParticipante
                            } // foreach reuniões
                        } // else $jaAconteceu
                        ?>

                        <!-- Modal para avaliação de NPS -->
            <div class="modal show bs-example-modal-lg" id="modalEditarCliente" >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4 class="modal-title">Avaliação NPS da Reunião</h4>
                      </div>
                      <div class="modal-body">
                        
                        <form role="form" method="post" action="<?= base_url('index.php/clientes/salvar')?>" id="formulario_clientes">
                          <div class="form-group">
                            <label for="nps-reuniao">De 1 a 10, o quanto você indicaria uma reunião desta comunidade para um amigo ou colega?</label>
                            (1- Jamais indicaria | 10- Indicaria com certeza)
                            <input type="number" class="form-control" min="1" max="10" id="nps-reuniao" name="nps-reuniao">
                          </div>
                        </form>     
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="$('#formulario_clientes').submit()">Avaliar reunião</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  