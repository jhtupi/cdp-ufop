

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
                            echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                            foreach ($departamentos as $departamento) {
                            echo form_open('admin/departamentos/salvar_alteracoes/'.$departamento->id); // Abre o formulário apontando pro método de inserção no controlador

                            
                            ?>
                            <!-- Nome -->
                            <div class="form-group">
                                <label id="txt-nome">Nome do Departamento</label>
                                <input type="text" id="txt-nome" name="txt-nome" class="form-control" placeholder="Digite o nome do usuário..." value= "<?php echo $departamento->nome ?>">
                            </div>
                            <input type="hidden" name="txt-id" id="txt-id" value= "<?php echo $departamento->id ?>">

                            <button type="submit" class="btn btn-default">Atualizar</button>

                            <?php
                             }
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
    </div>
            <!-- /.row -->
</div>
        <!-- /#page-wrapper -->
