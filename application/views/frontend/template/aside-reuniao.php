
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
                        if($hoje > $dataReuniao) { // Reunião já aconteceu
                            $jaAconteceu = True;
                        } else {}
                    } // foreach Reunioes

                    // Verifica se o usuário é membro da reunião
                        $ehParticipante = 0;
                        $jaAvaliou = 0;
                        foreach($participantes as $participante) {
                            if ($this->session->userdata('userlogado')->id == $participante->id){
                                $ehParticipante = 1;

                                // Verifica se o usuário já avaliou a reunião
                                foreach($participantes as $participante) {
                                    if ($participante->nps){
                                        $jaAvaliou = 1;
                                    } else {}
                        }
                            } else {}
                        }



                     if ($jaAconteceu) {

                        if ($ehParticipante) {
                            foreach($comunidades as $comunidade) { 
                        ?>
                    
                    <div class="well col-md-12">
                        <?php foreach($reunioes as $reuniao) {
                         ?>
                         <!-- Reunião já ocorreu | Usuário é participante -->
                        <form action="<?php echo base_url("'reuniao/'.$reuniao->id") ?>">
                            <input class="btn btn-default col-md-12"  type="submit" value="Postar Material" />
                        </form>
                            <?php if (!$jaAvaliou) { ?>
                                <br><br>
                                <button type="button" class="btn btn-default col-md-12" data-toggle="modal" data-target="#modal-NPS">Avaliar reunião</button>
                            <?php } // if jaAvaliou ?> 
                        <?php } // foreach Reunião ?> 
                        

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

                <div class="well col-md-12">
                    <h4>Comunidades destaque</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                foreach($destaques as $destaque) { 
                                                        // laço de repetição exclusivo para arrays
                                                        // alias $categoria
                                

                                                            // o '.' concatena com o id da categoria
                                                            // a função limpar() do helper serve para deixar a url mais limpa
                                ?>
                                    <li><a href="<?php echo base_url('comunidade/'.$destaque->id)?>"><?php echo $destaque->tema ?></a>
                                    </li> 
                                <?php   // A tag <li> tem que estar entre as chaves porém fora da chamada php
                                }            
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>

                        <!-- Modal para avaliação de NPS -->
            <div class="modal fade" id="modal-NPS" >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4 class="modal-title">Avaliação NPS da Reunião</h4>
                      </div>
                      <div class="modal-body">
                        
                        <form role="form" method="post" action="<?= base_url('reunioes/avaliar/'.$reuniao->id.'/'.$this->session->userdata('userlogado')->id)?>" id="form-NPS">
                          <div class="form-group">
                            <?php foreach($reunioes as $reuniao) {
                            ?>
                            <label for="nps-reuniao">De 1 a 10, o quanto você indicaria uma reunião desta comunidade para um amigo ou colega?</label>
                            (1- Jamais indicaria | 10- Indicaria com certeza)
                            <input type="number" class="form-control" min="1" max="10" id="nps-reuniao" name="nps-reuniao">
                            <input type="hidden" name="id-comunidade" id="id-comunidade" value="<?php echo $reuniao->id_comunidade ?>">
                            <?php } // foreach Reunião ?> 
                          </div>
                        </form>     
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="$('#form-NPS').submit()">Avaliar reunião</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->  