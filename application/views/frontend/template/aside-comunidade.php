
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
                $ehMembro = 0;
                    foreach($membros as $membro) {
                        if ($this->session->userdata('userlogado')->id == $membro->id){
                            $ehMembro = 1;
                        } else {}
                    }

                    if ($ehMembro) { // Caso o usuário seja administrador
                        foreach($comunidades as $comunidade) { 
                    ?>
                    <!-- Caso seja membro da comunidade -->
                    <div class="well col-md-12">
                        <form action="<?php echo base_url("criar_reuniao"."/".$comunidade->id."/".$this->session->userdata('userlogado')->id) ?>">
                            <input class="btn btn-default col-md-12"  type="submit" value="Criar reunião" />
                        </form>
                        <br><br>
                        <form action="<?php echo base_url("sair_comunidade"."/".$comunidade->id."/".$this->session->userdata('userlogado')->id) ?>">
                            <input class="btn btn-warning col-md-12"  type="submit" value="Sair da comunidade" />
                        </form>

                        <!-- Caso o usuário seja o criador da comunidade-->
                        <?php if ($this->session->userdata('userlogado')->id == $comunidade->id_usuario) {?>
                            <br><br>
                            <form action="<?php echo base_url("editar_comunidade"."/".$comunidade->id) ?>">
                            <input class="btn btn-default col-md-12"  type="submit" value="Editar comunidade" />
                            <br><br>
                            <form action="<?php echo base_url("excluir_comunidade"."/".$comunidade->id."/".$this->session->userdata('userlogado')->id) ?>">
                            <input class="btn btn-danger col-md-12"  type="submit" value="Excluir comunidade" />
                        </form>
                        <?php } // Fim if?>
                    </div>
                        
                <?php   } // foreach Comunidade
                    ?>   
                    
                <?php } else {
                            foreach($comunidades as $comunidade) {
                            ?>
                <!-- Caso não seja membro -->
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

        </div>