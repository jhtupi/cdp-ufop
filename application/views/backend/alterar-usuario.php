

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo 'Adicionar novo '.$subtitulo ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <?php
                                    if ($enviado == 1) { // Caso o usuário foi criado, exibe a mensagem de confirmação
                                        echo '<div class="alert alert-success"> Perfil atualizado! </div>';
                                    } else if ($enviado == 2) {
                                        echo '<div class="alert alert-warning"> Erro na validação do formulário! </div>';
                                    } else if ($enviado == 3) {
                                        echo '<div class="alert alert-warning"> Erro no banco de dados! </div>';
                                    }
                                     
                                    echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                                    foreach ($usuarios as $usuario) {
                                    echo form_open('admin/usuarios/salvar_alteracoes/'.$usuario->id.'/'.$usuario->user); // Abre o formulário apontando pro método de inserção no controlador

                                    
                                    ?>

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

                                    <!-- CPF -->
                                    <div class="form-group">
                                        <label id="txt-cpf">CPF</label>
                                        <input type="text" id="txt-cpf" name="txt-cpf" class="form-control" placeholder="Digite o seu CPF " value= "<?php echo $usuario->cpf ?>">
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

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo 'Imagem de destaque do '.$subtitulo.' existente' ?>
                        </div>
                        <div class="panel-body">

                            <!-- Estrutura para o mostrar a imagem -->
                            <div class="row" style= "padding-bottom: 10px;">
                                <div class="col-lg-3 col-lg-offset-3">
                                    <style type="text/css"> #foto { height: 200px;width: 200px;}</style>
                                    <?php 
                                    // Verifica se o usuário tem ou não imagem
                                    if($usuario->foto == 1) { 
                                        $mostraFoto= "assets/frontend/img/usuarios/".$usuario->id.".jpg"; 
                                    } else {
                                        $mostraFoto= "assets/frontend/img/semFoto.png"; 
                                    }
                                    ?>
                                    <img id="foto" class= "image "src="<?php echo base_url($mostraFoto) ?>" alt="">
                                </div>
                            </div>

                             <!-- Estrutura para o formulário da imagem -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 

                                    // Cria variáveis para formatar o formulário 
                                    $divopen= '<div class="form-group col-md-12">';
                                    $label = '<hr><label id="txt-nome">Alterar foto</label>';
                                    $divclose= '</div>';

                                    // Monta o formulário através de helpers
                                    echo form_open_multipart('admin/usuarios/nova_foto');   // Formulário especial para arquivos
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
                                }
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