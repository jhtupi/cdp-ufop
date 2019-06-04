

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
                           <?php echo 'Adicionar nova comunidade' ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 

                                        if ($criada == 1) { 
                                            echo '<div class="alert alert-success"> Comunidade criada! </div>';
                                        } else if ($criada == 2) {
                                            echo '<div class="alert alert-warning"> Comunidade não criada! Erro no formulário </div>';
                                        } else if ($criada == 3) {
                                            echo '<div class="alert alert-warning"> Comunidade não criada! Erro no banco de dados </div>';
                                        }
                                        
                                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                                        echo form_open(base_url('admin/comunidades/inserir')); // Abre o formulário apontando pro método de inserção no controlador
                                    ?>
                                    <!-- Tema -->
                                    <div class="form-group">
                                        <label id="txt-tema">Tema da comunidade</label>
                                        <input type="text"id="txt-tema" name="txt-tema" class="form-control" placeholder="Digite o tema da comunidade" value= "<?php echo set_value('txt-tema') ?>">
                                    </div>

                                    <!-- Descrição -->
                                    <div class="form-group">
                                        <label id="txt-descricao">Descrição</label>
                                        <textarea id="txt-descricao" name="txt-descricao" class="form-control" placeholder="Digite a descrição da sua comunidade" value= "<?php echo set_value('txt-descricao') ?>"></textarea>
                                    </div>

                                    <!-- ID Usuário -->
                                    <input type="hidden" id="txt-iduser" name="txt-iduser" class="form-control" value = <?php echo $this->session->userdata('userlogado')->id ?>>

                                    <button type="submit" class="btn btn-default">Criar Comunidade</button>
                                    
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
                                        $this->table->set_heading("Tema","Descrição","Alterar","Excluir"); 
                                        // Define as colunas da tabela
                                        foreach ($comunidades as $comunidade) {

                                            $temacomun = $comunidade->tema;
                                            $desccomun = $comunidade->descricao;
                                            $alterar= anchor(base_url('admin/comunidades/alterar/'.$comunidade->id), '<i class="fa fa-refresh fa-fw"></i> Alterar'); // Anchor serve para usar o helper
                                            $excluir= anchor(base_url('admin/comunidades/excluir/'.$comunidade->id.'/'.$comunidade->id_usuario), '<i class="fa fa-remove fa-fw"></i> Excluir'); // A vírgula serve de 'alias' 
                                                // A função md5() criptografa o id da categoria

                                            $this->table->add_row($temacomun,$desccomun,$alterar,$excluir); // Define cada uma das linhas
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