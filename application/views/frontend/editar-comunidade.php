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
                

                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter no sistema com uma div personalizada
                        echo form_open(base_url('comunidades/salvar_alteracoes')); // Abre o formulário apontando pro método de inserção no controlador

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