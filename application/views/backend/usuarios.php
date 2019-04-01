

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo 'Adicionar novo usuário' ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                                        echo form_open(base_url('criar_usuario/criar_usuario')); // Abre o formulário apontando pro método de inserção no controlador
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
                                        <label id="txt-telefone">Telefone do Usuário</label>
                                        <input type="text" id="txt-telefone" name="txt-telefone" class="form-control" placeholder="Digite o telefone do usuário..." value= "<?php echo set_value('txt-telefone') ?>">
                                    </div>

                                    <!-- Foto -->
                                    <div class="form-group">
                                        <label id="txt-foto">Foto do Usuário</label>
                                        <input type="text" id="txt-foto" name="txt-foto" class="form-control" placeholder="Foto do usuário..." value= "<?php echo set_value('txt-foto') ?>">
                                    </div>

                                    <!-- User -->
                                    <div class="form-group">
                                        <label id="txt-user">User</label>
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

                                    <button type="submit" class="btn btn-default">Cadastrar</button>
                                    
                                    <?php 
                                        echo form_close(); // Fecha o formulário
                                    ?>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $subtitulo.' existentes' ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <style>
                                        img {
                                            width: 60px;
                                        }
                                    </style>
                                    <?php 
                                        $this->table->set_heading("Foto","Nome do Usuário","Alterar","Excluir"); 
                                        // Define as colunas da tabela
                                        foreach ($usuarios as $usuario) {
                                            $nomeuser= $usuario->nome;
                                            // Verifica se o usuário tem ou não imagem
                                            if($usuario->img == 1) { 
                                                $fotouser= img("assets/frontend/img/usuarios/".md5($usuario->id).".jpg"); 
                                            } else {
                                                $fotouser= img("assets/frontend/img/semFoto.png"); 
                                            }
                                    
                                            $alterar= anchor(base_url('admin/usuarios/alterar/'.md5($usuario->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar'); // Anchor serve para usar o helper
                                            $excluir= anchor(base_url('admin/usuarios/excluir/'.md5($usuario->id)), '<i class="fa fa-remove fa-fw"></i> Excluir'); // A vírgula serve de 'alias' 
                                                // A função md5() criptografa o id da categoria

                                            $this->table->add_row($fotouser,$nomeuser,$alterar,$excluir); // Define cada uma das linhas
                                        }

                                        // Como vai ser exibida, a formatação da tabela
                                        $this->table->set_template(array(
                                            'table_open' => '<table class="table table-striped">'
                                            ));

                                        echo $this->table->generate(); // Gera a tabela

                                    ?>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->





<!-- 
<form role="form">
                                        <div class="form-group">
                                            <label>Titulo</label>
                                            <input class="form-control" placeholder="Entre com o texto">
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Destaque</label>
                                            <input type="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Conteúdo</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Selects</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Cadastrar</button>
                                        <button type="reset" class="btn btn-default">Limpar</button>
                                    </form>

                                    --> 