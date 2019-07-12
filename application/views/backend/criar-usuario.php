   

   <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align: center">Criar novo usuário</h3>
                    </div>
                    <div class="panel-body">

                        <?php 

                            if ($enviado == 1) { // Caso o usuário foi criado, exibe a mensagem de confirmação
                                echo '<div class="alert alert-success"> Usuário criado! </div>';
                            } else if ($enviado == 2) {
                                echo '<div class="alert alert-warning"> Usuário não criado! </div>';
                            }

                            echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                            echo form_open(base_url('usuarios/inserir')); // Abre o formulário apontando pro método de inserção no controlador
                        ?>
                        <!-- Nome -->
                        <div class="form-group">
                            <label id="txt-nome">Nome do Usuário</label>
                            <input type="text" id="txt-nome" name="txt-nome" class="form-control" placeholder="Digite o nome completo do usuário..." value= "<?php echo set_value('txt-nome') ?>">
                        </div>

                        <!-- E-mail -->
                        <div class="form-group">
                            <label id="txt-email">E-mail</label>
                            <input type="text" id="txt-email" name="txt-email" class="form-control" placeholder="Digite o e-mail do usuário..." value= "<?php echo set_value('txt-email') ?>">
                        </div>

                        <!-- CPF -->
                        <div class="form-group">
                            <label id="txt-cpf">CPF do Usuário</label>
                            <input type="text" id="txt-cpf" name="txt-cpf" class="form-control" placeholder="Digite o CPF do usuário..." value= "<?php echo set_value('txt-cpf') ?>">
                        </div>

                        <!-- Telefone -->
                        <div class="form-group">
                            <label id="txt-telefone">Telefone do Usuário (DDD + número) </label>
                            <input type="text" id="txt-telefone" name="txt-telefone" class="form-control" placeholder="Digite o telefone do usuário..." value= "<?php echo set_value('txt-telefone') ?>">
                        </div>

                        <!-- Usuário -->
                        <div class="form-group">
                            <label id="txt-user">Usuário</label>
                            <input type="text" id="txt-user" name="txt-user" class="form-control" placeholder="Digite o user do usuário..."  value= "<?php echo set_value('txt-user') ?>">
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

                        <button type="submit" class="btn btn-lg btn-success btn-block">Cadastrar</button>
                        
                        <?php 
                            echo form_close(); // Fecha o formulário
                        ?>

                        <br>
                        <nav class ="navbar" style="margin: 0; border: 0; padding: 0;">
                            <ul class="nav navbar-nav">
                                <li class=" nav">
                                    <a href="<?php echo base_url('login'); ?>">Voltar ao login</a> 
                                </li>
                            </ul>     
                              
                        </nav>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>