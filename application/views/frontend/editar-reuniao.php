<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                </h1>

                
                <!-- Formulário de conntato -->

                <div class="col-md-12">

                    <?php 
                    
                    foreach($reunioes as $reuniao) {
                

                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                        echo form_open(base_url('reunioes/salvar_alteracoes')); // Abre o formulário apontando pro método de inserção no controlador

                    ?>
                    <!-- Título -->
                    <div class="form-group">
                        <label id="txt-titulo">Título</label>
                        <input type="text" id="txt-titulo" name="txt-titulo" class="form-control" placeholder="Digite o título da reunião" value= "<?php echo $reuniao->titulo ?>">
                    </div>

                    <!-- Data -->
                    <div class="form-group">
                        <label id="txt-data">Data</label>
                        <input type="date" id="txt-data" name="txt-data" class="form-control" value= "<?php echo $reuniao->data ?>">
                    </div>

                    <!-- Horário -->
                    <div class="form-group">
                        <label id="txt-horario">Horário</label>
                        <input type="time" id="txt-horario" name="txt-horario" class="form-control" value= "<?php echo $reuniao->horario ?>">
                    </div>

                    <!-- Local -->
                    <div class="form-group">
                        <label id="txt-local">Local</label>
                        <input type="text" id="txt-local" name="txt-local" class="form-control" placeholder="Digite o local da reunião" value= "<?php echo $reuniao->local ?>">
                    </div>

                    <!-- Resumo -->
                    <div class="form-group">
                        <label id="txt-resumo">Resumo</label>
                        <input type="textarea" id="txt-resumo" name="txt-resumo" class="form-control" placeholder="Digite o resumo da reunião" value= "<?php echo $reuniao->resumo ?>">
                    </div>

                    <!-- ID Reunião -->
                    <input type="hidden" id="txt-id" name="txt-id" class="form-control" value = "<?php echo $reuniao->id ?>">

                    

                    <button type="submit" class="btn btn-md btn-default btn-block">Atualizar reunião</button>
                    
                    <?php 
                        echo form_close(); // Fecha o formulário
                    }
                    ?>

                </div>

            </div> 