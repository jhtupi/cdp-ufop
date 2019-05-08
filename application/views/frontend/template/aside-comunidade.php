
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
                <?php
                    foreach($comunidades as $comunidade) {
                ?>
                <!-- Blog Categories Well -->
                <div class="well">
                    <form action="<?php echo base_url("criar_reuniao"."/".$comunidade->id."/".$this->session->userdata('userlogado')->id) ?>">
                        <input class="btn btn-default"  type="submit" value="Criar reunião" />
                    </form>
                    
                <?php } ?>   
                    <!-- /.row -->
                </div>

            </div>