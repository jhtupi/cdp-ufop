<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo; ?>
                </h1>

                <?php
                    foreach($reunioes as $reuniao) {
                        if ($enviado == 1) { // Caso o usuário foi criado, exibe a mensagem de confirmação
                            echo '<div class="alert alert-success"> Reunião atualizada! </div>';
                        } else if ($enviado == 2) {
                            echo '<div class="alert alert-warning"> Erro na validação do formulário! </div>';
                        } else if ($enviado == 3) {
                            echo '<div class="alert alert-warning"> Erro no banco de dados! </div>';
                        }
                ?>
                    <h2>
                        <?php echo $reuniao->titulo ?>
                    </h2>


                    <br>
                    <p class="lead">
                        Data: <a> <?php echo $reuniao->data ?></a>
                        Horário: <a> <?php echo $reuniao->horario ?></a>
                        <br>
                        Local: <a> <?php echo $reuniao->local ?></a>
                        <br>
                        <?php 
                        foreach($comunidades as $comunidade) { ?>
                        Comunidade: <a href="<?php echo base_url('comunidade/'.$comunidade->id)?>">
                            <?php
                            
                            if($reuniao->id_comunidade == $comunidade->id) {
                                echo $comunidade->tema;
                            }
                        }?></a>
                        
                        <?php   if($reuniao->nps <= 100) { ?>
                            <br>NPS: <a> <?php echo $reuniao->nps ?></a>
                        <?php } ?>

                    </p>
                    <br>
                    <p class="">
                        <?php echo $reuniao->resumo ?>
                    </p>
                    <hr>

                    <div class="col-md-12 col-xs-12">
                        <h2>Participantes da reunião</h2>
                        <br>
                            <?php 
                            foreach($participantes as $participante) {
                            ?>
                        <div class="col-md-2 col-xs-3">
                            <?php 
                                // Verifica se o usuário tem ou não imagem
                                if($participante->foto == 1) { 
                                    $mostraFoto= "assets/frontend/img/usuarios/".$participante->id.".jpg"; 
                                } else {
                                    $mostraFoto= "assets/frontend/img/semFoto.png"; 
                                }
                            ?>
                            <img class="img-responsive img-circle" style="width: 7vw; height: 7vw;" src="<?php echo base_url($mostraFoto) ?>" alt="">
                            <figcaption>
                                <h4 class="text-center">
                                    <a href="<?php echo base_url('usuario/'.$participante->id) ?>"><?php echo $participante->nome ?></a>
                                </h4> 
                            </figcaption>
                        </figure>
                        </div>

                        <!-- Foreach participantes -->   
                        <?php
                            }
                        ?>
                    </div>                     

                    
                    

                    <div class="col-md-12 col-xs-12">
                        <br>
                    <hr>
                        <p class="lead">
                            Materiais
                            <br>

                            <?php foreach($materiais as $material) { ?>
                                <style> #material{font-size: 15px;}</style>
                                <a id="material" href="<?php echo base_url('reunioes/download_material/'.$reuniao->id.'/'.$material->arquivo)?>"><?php echo $material->arquivo ?></a> 

                                <!-- Caso o usuário seja quem postou o material-->
                                <?php if($material->id_usuario == $this->session->userdata('userlogado')->id) { ?>
                                 - <a id="material" href="<?php echo base_url('reunioes/excluir_material/'.$material->id.'/'.$reuniao->id)?>">Excluir material</a>
                                <?php } ?>
                                
                                <br>
                            </p>
                            <?php } ?>
                        </p>
                        <hr>
                        
                        <p class="lead">
                            Comentários
                            <br>
                            <p>
                            <?php foreach($comentarios as $comentario) { ?>
                                <?php echo date('d/m/Y',$comentario->timestamp);?> - <?php echo date('H:m:s',$comentario->timestamp);?> 
                                <?php if($comentario->id == $this->session->userdata('userlogado')->id) { ?>
                                <a href="<?php echo base_url('reunioes/excluir_comentario/'.$comentario->id.'/'.$reuniao->id.'/'.$comentario->timestamp)?>">Excluir comentário</a>
                                <?php } ?>
                                <br>
                                <b><?php echo $comentario->nome;?>:</b>  <?php echo $comentario->comentario;?>
                            </p>
                            <?php } ?>
                            <?php 
                            echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                            echo form_open(base_url('reunioes/enviar_comentario')); // Abre o formulário apontando pro método de inserção no controlador
                            ?>
                            <!-- Comentário -->
                            <div class="form-group">
                                <label id="txt-comentario"></label>
                                <input type="text" id="txt-comentario" name="txt-comentario" class="form-control" placeholder="Deixe aqui seu comentário" value= "<?php echo set_value('txt-comentario') ?>">
                            </div>

                            <!-- ID Reunião -->
                            <input type="hidden" id="txt-reuniao" name="txt-reuniao" class="form-control" value = <?php echo $reuniao->id ?>>
                            <!-- ID Usuário -->
                            <input type="hidden" id="txt-usuario" name="txt-usuario" class="form-control" value = <?php echo $this->session->userdata('userlogado')->id ?>>
                                <button type="submit" class="btn btn-md btn-default ">Enviar comentário</button>
                        </p>
                    </div>  
                        <?php 
                        echo form_close(); // Fecha o formulário
                        ?>
                        <hr>    
                    
                    
                <?php 
                }
                ?>

            </div>