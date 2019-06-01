<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                </h1>

                <?php
                    foreach($reunioes as $reuniao) {
                ?>
                     <!-- Carrega a imagem caso houver-->
                    <h2>
                        <?php echo $reuniao->titulo ?>
                    </h2>
                    <br>
                    <?php 
                       if($reuniao->imagem == 1) { // Se houver imagem
                           $fotoreuniao = base_url("assets/frontend/img/reunioes/".md5($reuniao->id).".jpg");
                       } else {
                            $fotoreuniao= "assets/frontend/img/semFoto2.png"; 
                        }
                    ?>
                    <img class="img-responsive img-circle" src="<?php echo base_url($fotoreuniao) ?>" alt="">
                    <hr>
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
                        
                        <?php   if($reuniao->nps != NULL) { ?>
                            <br>NPS: <a> <?php echo $reuniao->nps ?></a>
                        <?php } ?>

                    </p>
                    <br>
                    <p class="">
                        <?php echo $reuniao->resumo ?>
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
                        <?php 
                        echo form_close(); // Fecha o formulário
                        ?>
                        <hr>    
                    
                    
                <?php 
                }
                ?>

            </div>