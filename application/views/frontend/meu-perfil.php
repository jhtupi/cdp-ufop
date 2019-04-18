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
                ?>
                     
                    <div class="col-md-4">
                        <?php 
                            // Verifica se o usuário tem ou não imagem
                            if($usuario->foto == 1) { 
                                $mostraFoto= "assets/frontend/img/usuarios/".md5($usuario->id).".jpg"; 
                            } else {
                                $mostraFoto= "assets/frontend/img/semFoto.png"; 
                            }
                        ?>
                        <img class="img-responsive img-circle" src="<?php echo base_url($mostraFoto) ?>" alt="">
                    </div>
            
                    <h2>
                       <?php echo $usuario->nome ?>
                    </h2>
                    <h3>
                       DEPARTAMENTO
                    </h3>  
                    <hr>
                    <p><b>E-mail: </b><?php echo $usuario->email ?></p>
                    <p><b>Telefone: </b><?php echo $usuario->telefone ?></p>
                    <p><b>CPF: </b><?php echo $usuario->cpf ?></p>


                    <hr>
                
                


                <!-- Alterar usuário -->
                
                    <?php 
                    echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                    
                    echo form_open('admin/usuarios/salvar_alteracoes/'.md5($usuario->id).'/'.$usuario->user); // Abre o formulário apontando pro método de inserção no controlador

                    
                    ?>
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
