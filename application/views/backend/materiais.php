

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
                           <?php echo $subtitulo.' existentes' ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                        $this->table->set_heading("Arquivo","Usuario","Reuniao","Excluir"); 
                                        // Define as colunas da tabela
                                        foreach ($materiais as $material) {
                                            // Verifica se o usuário tem ou não imagem

                                            $arquivo = anchor(base_url('reunioes/download_material/'.$material->idReuniao.'/'.$material->arquivo), $material->arquivo); // A vírgula serve de 'alias' 
                                            //$arquivo = $material->arquivo;
                                            $usuario = $material->nome;
                                            $reuniao = $material->reuniao;
                                            
                                            $excluir= anchor(base_url('admin/reunioes/excluir_material/'.$material->id.'/'.$material->idReuniao), '<i class="fa fa-remove fa-fw"></i> Excluir'); // A vírgula serve de 'alias' 
                                                // A função md5() criptografa o id da categoria

                                            $this->table->add_row($arquivo,$usuario,$reuniao,$excluir); // Define cada uma das linhas
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