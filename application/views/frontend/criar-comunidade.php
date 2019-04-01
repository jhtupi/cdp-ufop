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

                        if ($enviado == 1) { // Caso o e-mail foi enviado, exibe a mensagem de confirmação
                            echo '<div class="alert alert-success"> E-mail enviado! </div>';
                        } else if ($enviado == 2) {
                            echo '<div class="alert alert-warning"> E-mail não enviado! </div>';
                        }

                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação 

                        $atributosForm = array('name' => 'formulario_contato', 'id'=> 'formulario_contato');
                        echo form_open(base_url('contato/enviar_mensagem'),$atributosForm);

                        $atribTitulo= array('name'=>'txtTitulo','id'=>'txtTitulo','class'=>'form-control','placeholder'=>'Digite o título da reunião', 
                            'value' => set_value('txtTitulo'));
                        echo("<div class='form-group'>").
                        form_label("Titulo",'txtTitulo').
                        form_input($atribTitulo).
                        ("</div>");

                        $atribDescrição= array('name'=>'txtDescricao','id'=>'txtDescricao','class'=>'form-control','placeholder'=>'Digite a descrição da comunidade',
                            'value' => set_value('txtDescricao'));
                        echo("<div class='form-group'>").
                        form_label("Descrição",'txtDescricao').
                        form_textarea($atribDescrição).
                        (" </div>");

                        $atribImg= array('name'=>'txtImg','id'=>'txtImg','class'=>'form-control','placeholder'=>'Imagem', 
                            'value' => set_value('txtImg'));
                        echo("<div class='form-group'>").
                        form_label("Imagem",'txtImg').
                        form_input($atribImg).
                        (" </div>");

                        
                        echo form_submit('btn_enviar','Criar Comunidade');
                        
                        echo form_close();

                    ?>
                </div>
               

            </div> 