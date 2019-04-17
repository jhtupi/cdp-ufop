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
                            echo '<div class="alert alert-success"> Reunião criada! </div>';
                        } else if ($enviado == 2) {
                            echo '<div class="alert alert-warning"> Reunião não criada! </div>';
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


                        $atribData= array('name'=>'txtData','id'=>'txtData','type' => 'date','class'=>'form-control','placeholder'=>'Data', 
                            'value' => set_value('txtData'));
                        echo("<div class='form-group'>").
                        form_label("Data",'txtData').
                        form_input($atribData).
                        (" </div>");

                        $atribHorario= array('name'=>'txtHorario','id'=>'txtHorario','type' => 'time','class'=>'form-control','placeholder'=>'Horário', 
                            'value' => set_value('txtHorario'));
                        echo("<div class='form-group'>").
                        form_label("Horario",'txtHorario').
                        form_input($atribHorario).
                        (" </div>");



                        $atribResumo= array('name'=>'txtResumo','id'=>'txtResumo','class'=>'form-control','placeholder'=>'Digite o resumo da sua reunião',
                            'value' => set_value('txtResumo'));
                        echo("<div class='form-group'>").
                        form_label("Resumo",'txtResumo').
                        form_textarea($atribResumo).
                        (" </div>");

                        $atribImg= array('name'=>'txtImg','id'=>'txtImg','class'=>'form-control','placeholder'=>'Imagem', 
                            'value' => set_value('txtImg'));
                        echo("<div class='form-group'>").
                        form_label("Imagem",'txtImg').
                        form_input($atribImg).
                        (" </div>");

                        
                        echo form_submit('btn_enviar','Criar Reunião');
                        
                        echo form_close();

                    ?>
                </div>
               

            </div> 