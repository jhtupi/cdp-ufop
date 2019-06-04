

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
                                    <style>
                                        img {
                                            width: 60px;
                                        }
                                    </style>
                                    <?php 
                                        $this->table->set_heading("Título","Resumo","Alterar","Excluir"); 
                                        // Define as colunas da tabela
                                        foreach ($reunioes as $reuniao) {

                                            $tituloreun = $reuniao->titulo;
                                            $resumoreun = $reuniao->resumo;
                                            
                                            $alterar= anchor(base_url('admin/reunioes/alterar/'.$reuniao->id), '<i class="fa fa-refresh fa-fw"></i> Alterar'); // Anchor serve para usar o helper
                                            $excluir= anchor(base_url('admin/reunioes/excluir/'.$reuniao->id), '<i class="fa fa-remove fa-fw"></i> Excluir'); // A vírgula serve de 'alias' 
                                                // A função md5() criptografa o id da categoria

                                            $this->table->add_row($tituloreun,$resumoreun,$alterar,$excluir); // Define cada uma das linhas
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
