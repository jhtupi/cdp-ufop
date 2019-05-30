
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Busca no site</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>
                
                <!-- Blog Categories Well -->
                <div class="well col-md-12">
                    <form action="<?php echo base_url("criar_comunidade") ?>">
                        <input class="btn btn-default col-md-12"  type="submit" value="Criar comunidade" />
                    </form>
                    <br><br>
                </div>

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
                

            </div>