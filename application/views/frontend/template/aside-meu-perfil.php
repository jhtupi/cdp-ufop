
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">


                <div class="well">
                    <h4>Opções de usuário</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <form action="<?php echo base_url("excluir/".$this->session->userdata('userlogado')->id) ?>">
                                    <input class="btn btn-danger col-md-12"  type="submit" value="Excluir minha conta" />
                                </form>
                                
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Blog Categories Well -->
                <?php if ($destaques != null) {
                 ?>
                    <div class="well col-md-12">
                        <h4>Comunidades destaque</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-unstyled">
                                    <?php
                                    foreach($destaques as $destaque) { 
                                                            // laço de repetição exclusivo para arrays
                                                            // alias $categoria
                                    

                                                                // o '.' concatena com o id da categoria
                                                                // a função limpar() do helper serve para deixar a url mais limpa
                                    ?>
                                        <li><a href="<?php echo base_url('comunidade/'.$destaque->id)?>"><?php echo $destaque->tema ?></a>
                                        </li> 
                                    <?php   // A tag <li> tem que estar entre as chaves porém fora da chamada php
                                    }            
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>