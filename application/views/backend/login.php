   

   <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Entrar no Sistema</h3>
                    </div>
                    <div class="panel-body">

                        <?php 
                            echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                            echo form_open('admin/usuarios/login'); // Abre o formulário apontando pro método de inserção no controlador
                        ?>

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="txt-user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="txt-senha" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Entrar</button>
                            </fieldset>

                        <?php 
                            echo form_close(); // Fecha o formulário
                        ?>         
                        <br>

                        <nav class ="navbar" style="margin: 0; border: 0; padding: 0;">
                            <ul class="nav navbar-nav">
                                <li class=" nav">
                                    <a href="<?php echo base_url('admin'); ?>">Esqueci minha senha</a> 
                                </li>
                            </ul>     
                            <ul style="float: right;" class="nav navbar-nav">
                                <li class=" nav">
                                    <a href="<?php echo base_url('admin'); ?>">Criar usuário</a> 
                                </li>
                            </ul>     
                        </nav>


                        
                    </div>
                </div>
            </div>
        </div>
    </div>