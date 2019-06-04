

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
                           <?php echo 'Adicionar novo '.$subtitulo ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <?php
                                    if ($enviado == 1) { // Caso o usuário foi criado, exibe a mensagem de confirmação
                                        echo '<div class="alert alert-success"> Comunidade atualizada! </div>';
                                    } else if ($enviado == 2) {
                                        echo '<div class="alert alert-warning"> Erro na validação do formulário! </div>';
                                    } else if ($enviado == 3) {
                                        echo '<div class="alert alert-warning"> Erro no banco de dados! </div>';
                                    }
                                     
                                    echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                                    foreach ($comunidades as $comunidade) {
                                    echo form_open('admin/comunidades/salvar_alteracoes'); // Abre o formulário apontando pro método de inserção no controlador

                                    
                                    ?>

                                    <!-- Tema -->
                                    <div class="form-group">
                                        <label id="txt-tema">Tema</label>
                                        <input type="text" id="txt-tema" name="txt-tema" class="form-control" placeholder="Digite o título da reunião" value= "<?php echo $comunidade->tema ?>">
                                    </div>

                                    <!-- Descrição -->
                                    <div class="form-group">
                                        <label id="txt-descricao">Descrição</label>
                                        <input type="text" id="txt-descricao" name="txt-descricao" class="form-control" value= "<?php echo $comunidade->descricao ?>">
                                    </div>

                                    <!-- ID Comunidade -->
                                    <input type="hidden" id="txt-id" name="txt-id" class="form-control" value = "<?php echo $comunidade->id ?>">

                                    

                                    <button type="submit" class="btn btn-md btn-default btn-block">Atualizar comunidade</button>

                                    <?php
                                    echo form_close(); // Fecha o formulário
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
                <!-- /.col-lg-12 -->

                
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