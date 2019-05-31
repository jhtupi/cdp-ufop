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

                        if ($criada == 1) { 
                            echo '<div class="alert alert-success"> Comunidade criada! </div>';
                        } else if ($criada == 2) {
                            echo '<div class="alert alert-warning"> Comunidade não criada! Erro no formulário </div>';
                        } else if ($criada == 3) {
                            echo '<div class="alert alert-warning"> Comunidade não criada! Erro no banco de dados </div>';
                        }

                        echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação 

                        $atributosComunidade = array('name' => 'formulario_comunidade', 'id'=> 'formulario_comunidade');
                        echo form_open(base_url('comunidades/inserir'),$atributosComunidade);

                        $atribTema= array('name'=>'txt-tema','id'=>'txt-tema','class'=>'form-control','placeholder'=>'Digite o tema da comunidade', 
                            'value' => set_value('txt-tema'));
                        echo("<div class='form-group'>").
                        form_label("Tema",'txt-tema').
                        form_input($atribTema).
                        ("</div>");

                        $atribDescrição= array('name'=>'txt-descricao','id'=>'txt-descricao','class'=>'form-control','placeholder'=>'Digite a descrição da comunidade',
                            'value' => set_value('txt-descricao'));
                        echo("<div class='form-group'>").
                        form_label("Descrição",'txt-descricao').
                        form_textarea($atribDescrição).
                        (" </div>");
                        echo form_hidden('txt-iduser', $this->session->userdata('userlogado')->id);


                        /* Adicionar imagem 
                        $divopen= '<div class="form-group">';
                        $divclose= '</div>';
                        echo form_open_multipart('comunidades/nova_foto');   // Formulário especial para arquivos
                        echo form_hidden('id', md5($this->session->userdata('userlogado')->id));
                        echo $divopen.form_label("Imagem",'txtImg');

                        // O simbolo '=>' serve para apontar
                        // Cria uma variável para montar os formulários formatados
                        $imagem= array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
                        echo form_upload($imagem); // O identificador neste upload deve ser sempre userfile
                        echo $divclose;
                        echo $divopen;
                        $botao= array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-default', 'value' => 'Adicionar foto');
                        echo form_submit($botao);
                        echo $divclose;
                        echo form_close();*/

                        $botao2= array('name' => 'btn_enviar', 'id' => 'btn_enviar', 'class' => 'btn btn-lg btn-success btn-block col-lg-12', 'value' => 'Criar Comunidade');
                        echo form_submit($botao2);
                        
                        echo form_close();

                    ?>
                </div>
               

            </div> 