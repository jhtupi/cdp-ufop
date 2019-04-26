

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
                           <?php echo 'Adicionar nova reunião' ?>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                                        echo form_open(base_url('criar_usuario/criar_usuario')); // Abre o formulário apontando pro método de inserção no controlador
                                    ?>
                                    <!-- Título -->
                                    <div class="form-group">
                                        <label id="txt-titulo">Título da reunião</label>
                                        <input type="text"id="txt-titulo" name="txt-titulo" class="form-control" placeholder="Digite o título da reunião" value= "<?php echo set_value('txt-titulo') ?>">
                                    </div>

                                     <!-- IMG -->
                                    <div class="form-group">
                                        <label id="txt-img">Imagem da Reunião</label>
                                        <input type="text" id="txt-img" name="txt-img" class="form-control" placeholder="A CONFIGURAR" value= "<?php echo set_value('txt-img') ?>">
                                    </div>

                                    <!-- Data -->
                                    <div class="form-group">
                                        <label id="txt-data">Data da reunião</label>
                                        <input type="date"id="txt-data" name="txt-data" class="form-control" placeholder="Digite o título da reunião" value= "<?php echo set_value('txt-data') ?>">
                                    </div>

                                    <!-- Horário -->
                                    <div class="form-group">
                                        <label id="txt-hora">Horário da reunião</label>
                                        <input type="time"id="txt-hora" name="txt-hora" class="form-control" placeholder="Digite o título da reunião" value= "<?php echo set_value('txt-hora') ?>">
                                    </div>

                                    <!-- Resumo -->
                                    <div class="form-group">
                                        <label id="txt-resumo">Resumo</label>
                                        <textarea id="txt-resumo" name="txt-resumo" class="form-control" placeholder="Digite o resumo da sua reunião" value= "<?php echo set_value('txt-resumo') ?>"></textarea>
                                    </div>

                                   
                                    <button type="submit" class="btn btn-default">Criar Reunião</button>
                                    
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
                <!-- /.col-lg-12 -->

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
                                        $this->table->set_heading("Imagem","Título","Resumo","Alterar","Excluir"); 
                                        // Define as colunas da tabela
                                        foreach ($reunioes as $reuniao) {
                                            // Verifica se o usuário tem ou não imagem
                                            if($reuniao->imagem == 1) { 
                                                $imgreun= img("assets/frontend/img/reunioes/".md5($reuniao->id).".jpg"); 
                                            } else {
                                                $imgreun= img("assets/frontend/img/semFoto.png"); 
                                            }

                                            $tituloreun = $reuniao->titulo;
                                            $resumoreun = $reuniao->resumo;
                                            
                                            $alterar= anchor(base_url('admin/reunioes/alterar/'.md5($reuniao->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar'); // Anchor serve para usar o helper
                                            $excluir= anchor(base_url('admin/reunioes/excluir/'.md5($reuniao->id)), '<i class="fa fa-remove fa-fw"></i> Excluir'); // A vírgula serve de 'alias' 
                                                // A função md5() criptografa o id da categoria

                                            $this->table->add_row($imgreun,$tituloreun,$resumoreun,$alterar,$excluir); // Define cada uma das linhas
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