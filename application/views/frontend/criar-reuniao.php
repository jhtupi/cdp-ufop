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
                    
                    foreach($comunidades as $comunidade) {
                

                        if ($criada == 2) {
                            echo '<div class="alert alert-warning"> Reunião não criada! </div>';
                        }

                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                        echo form_open(base_url('reunioes/inserir')); // Abre o formulário apontando pro método de inserção no controlador
                    ?>
                    <!-- Título -->
                    <div class="form-group">
                        <label id="txt-titulo">Título</label>
                        <input type="text" id="txt-titulo" name="txt-titulo" class="form-control" placeholder="Digite o título da reunião" value= "<?php echo set_value('txt-titulo') ?>">
                    </div>

                    <!-- Data -->
                    <div class="form-group">
                        <label id="txt-data">Data</label>
                        <input type="date" id="txt-data" name="txt-data" class="form-control" value= "<?php echo set_value('txt-data') ?>">
                    </div>

                    <!-- Horário -->
                    <div class="form-group">
                        <label id="txt-horario">Horário</label>
                        <input type="time" id="txt-horario" name="txt-horario" class="form-control" value= "<?php echo set_value('txt-horario') ?>">
                    </div>

                    <!-- Local -->
                    <div class="form-group">
                        <label id="txt-local">Local</label>
                        <input type="text" id="txt-local" name="txt-local" class="form-control" placeholder="Digite o local da reunião" value= "<?php echo set_value('txt-local') ?>">
                    </div>

                    <!-- Resumo -->
                    <div class="form-group">
                        <label id="txt-resumo">Resumo</label>
                        <input type="textarea" id="txt-resumo" name="txt-resumo" class="form-control" placeholder="Digite o resumo da reunião" value= "<?php echo set_value('txt-resumo') ?>">
                    </div>

                    <!-- ID Usuário -->
                    <input type="hidden" id="txt-iduser" name="txt-iduser" class="form-control" value = <?php echo $this->session->userdata('userlogado')->id ?>>

                    <!-- ID Comunidade -->
                    <input type="hidden" id="txt-comunidade" name="txt-comunidade" class="form-control" value = <?php echo $comunidade->id ?>>

                    <button type="submit" class="btn btn-lg btn-success btn-block">Criar reunião</button>
                    
                    <?php 
                        echo form_close(); // Fecha o formulário
                    }
                    ?>

                </div>

            </div> 