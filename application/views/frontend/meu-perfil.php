<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                </h1>

                <?php
                    foreach($usuarios as $usuario) {
                        if ($enviado == 1) { // Caso o usuário foi criado, exibe a mensagem de confirmação
                            echo '<div class="alert alert-success"> Perfil atualizado! </div>';
                        } else if ($enviado == 2) {
                            echo '<div class="alert alert-warning"> Erro na validação do formulário! </div>';
                        } else if ($enviado == 3) {
                            echo '<div class="alert alert-warning"> Erro no banco de dados! </div>';
                        }
                ?>
                     
                    <div class="col-md-4">
                        <?php 
                            // Verifica se o usuário tem ou não imagem
                            if($usuario->foto == 1) { 
                                $mostraFoto= "assets/frontend/img/usuarios/".$usuario->id.".jpg"; 
                            } else {
                                $mostraFoto= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <img class="img-responsive img-circle" src="<?php echo base_url($mostraFoto) ?>" alt="">
                    </div>
                    <div class="col-md-8">
                        <h2>
                           <?php echo $usuario->nome ?>
                        </h2>
                        
                        <hr>
                        <p><b>E-mail: </b><?php echo $usuario->email ?></p>
                        <p><b>Telefone: </b><?php echo $usuario->telefone ?></p>
                        <p><b>CPF: </b><?php echo $usuario->cpf ?></p>
                        <p><b>Departamento: </b><?php echo $usuario->depto ?></p>

                    
                    </div>                   

                    
                    
                    <!-- Alterar foto do usuário -->
                        
                    
                    
                    <?php 

                    // Cria variáveis para formatar o formulário 
                    $divopen= '<div class="form-group col-md-12">';
                    $label = '<hr><label id="txt-nome">Alterar foto</label>';
                    $divclose= '</div>';

                    // Monta o formulário através de helpers
                    echo form_open_multipart('usuarios/nova_foto');   // Formulário especial para arquivos
                    echo form_hidden('id', $usuario->id);
                    echo $divopen;
                    echo $label;


                    // O simbolo '=>' serve para apontar
                    // Cria uma variável para montar os formulários formatados
                    $imagem= array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
                    echo form_upload($imagem); // O identificador neste upload deve ser sempre userfile
                    echo $divclose;
                    echo $divopen;
                    $botao= array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-default',
                        'value' => 'Adicionar nova foto');
                    echo form_submit($botao);
                    echo $divclose;
                    echo form_close();    
                    ?>
                

                <!-- Alterar usuário -->
                
                    <?php 
                    
                    echo form_open('usuarios/salvar_alteracoes/'.$usuario->user); // Abre o formulário apontando pro método de inserção no controlador

                    
                    ?>
                    <div class ="col-md-12">

                        <!-- Departamento -->
                        
                        <div class="form-group">
                            <label>Departamento</label>
                            <select class="form-control" name="txt-depto"> 
                                <option value="">Escolha um departamento</option>
                                <?php
                                foreach($departamentos as $departamento) {
                                    if($departamento->id == $usuario->idDepto){
                                        echo '<option value="'.$departamento->id.'" selected >'.$departamento->nome.'</option>';
                                    } else {
                                        echo '<option value="'.$departamento->id.'">'.$departamento->nome.'</option>';
                                    }
                                }
                                ?>  
                            </select>
                        </div>
                        

                        <!-- Nome -->
                        <div class="form-group">
                            <label id="txt-nome">Nome do Usuário</label>
                            <input type="text" id="txt-nome" name="txt-nome" class="form-control" placeholder="Digite o seu nome" value= "<?php echo $usuario->nome ?>">
                        </div>

                        <!-- User -->
                        <div class="form-group">
                            <label id="txt-user">User</label>
                            <input type="text" id="txt-user" name="txt-user" class="form-control" placeholder="Digite o seu user" value= "<?php echo $usuario->user ?>">
                        </div>

                        <!-- E-mail -->
                        <div class="form-group">
                            <label id="txt-email">E-mail</label>
                            <input type="text" id="txt-email" name="txt-email" class="form-control" placeholder="Digite o seu e-mail " value= "<?php echo $usuario->email ?>">
                        </div>

                        <!-- Telefone -->
                        <div class="form-group">
                            <label id="txt-telefone">Telefone</label>
                            <input id="txt-telefone" name="txt-telefone" class="form-control" placeholder="Digite o seu telefone" value= "<?php echo $usuario->telefone ?>">
                        </div>

                        <!-- Senha -->
                        <div class="form-group">
                            <label id="txt-senha">Senha</label>
                            <input type="password" id="txt-senha" name="txt-senha" class="form-control">
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="form-group">
                            <label id="txt-confir-senha">Confirmar Senha</label>
                            <input type="password" id="txt-confir-senha" name="txt-confir-senha" class="form-control">
                        </div>
                        <input type="hidden" name="txt-id" id="txt-id" value= "<?php echo $usuario->id ?>">

                        <button type="submit" class="btn btn-default">Atualizar</button>

                        <?php
                         
                        echo form_close(); // Fecha o formulário
                        }
                        ?>
                    </div>
                </div>
