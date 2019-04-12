   

   <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align: center">Recuperação de senha</h3>
                    </div>
                    <div class="panel-body">
                        Digite os dados da sua conta para que você receba um e-mail com sua senha
                        <br><br>
                        <?php 
                            echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                            echo form_open(base_url('criar_usuario/criar_usuario')); // Abre o formulário apontando pro método de inserção no controlador
                        ?>


                        <!-- E-mail -->
                        <div class="form-group">
                            <label id="txt-email">E-mail</label>
                            <input type="text" id="txt-email" name="txt-email" class="form-control" placeholder="Digite o e-mail da sua conta" value= "<?php echo set_value('txt-email') ?>">
                        </div>

                        <!-- CPF -->
                        <div class="form-group">
                            <label id="txt-cpf">CPF</label>
                            <input type="text" id="txt-cpf" name="txt-cpf" class="form-control" placeholder="Digite o CPF da sua conta" value= "<?php echo set_value('txt-cpf') ?>">
                        </div>

                        <button type="submit" class="btn btn-lg btn-success btn-block">Enviar</button>
                        
                        <?php 
                            echo form_close(); // Fecha o formulário
                        ?>
                        <br>
                        <nav class ="navbar" style="margin: 0; border: 0; padding: 0;float: ;">
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