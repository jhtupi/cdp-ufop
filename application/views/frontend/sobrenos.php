<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $titulo ?>
                    <small>> <?php 
                    if($subtitulo != '') {      // Cria a condicional para puxar ou não o subtitulo do banco de dados
                        echo $subtitulo;
                    } else {
                        foreach($subtitulodb as $dbtitulo) {
                            echo $dbtitulo->titulo;
                        }
                    }
                    ?></small>
                </h1>

                  <div class="col-md-12 "> 
                    
                    <h2>
                        CdP-UFOP
                    </h2>
                    <p>O CdP-UFOP é uma plataforma que tem como objetivo fomentar a criação de Comunidades de Prática (CoP) entre professores da UFOP e armazene o conteúdo gerado durante as discussões. Em linhas gerais, a plataforma deve servir como um incentivo à troca de conhecimentos entre os professores, além da armazenagem e gestão deste conhecimento.</p>
                    <hr>
                    <h2>
                        Funcionamento
                    </h2>
                    <p>Os usuários da plataforma são os docentes da UFOP. Qualquer usuário pode criar uma comunidade com um tema que deseja discutir com outros docentes. Apenas o criador da comunidade pode excluí-la ou editar seus dados.</p>
                    <p>Qualquer usuário pode participar de uma comunidade, uma vez dentro, o usuário pode agendar uma reunião daquela comunidade conforme a data, horário e local que escolher. Para os docentes que desejarem participar daquela reunião, basta clicar na opção de participar. Apenas o criador da reunião pode excluí-la ou editar seus dados.</p>
                    <p>Uma vez passada a data e horário da reunião, os membros poderão avaliá-la em sua página e postar materiais (documentos Word, Excel, PDF ou imagens) que desejarem sobre a discussão feita na reunião e fazer comentários em sua página.</p>
                    <p></p>
                    <hr>
                    <h2>
                        Comunidades de Prática (CoPs)
                    </h2>

                    <p>
                    São grupos de pessoas que compartilham de uma preocupação ou paixão por algo que fazem e aprendem como fazer melhor enquanto interagem regularmente.
                    </p><br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/e_KL0YcxBko" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    <br><br><p>
                    Existem vários tipos de comunidade, mas para ser denominada uma comunidade de prática, sua constituição depende de três características principais:
                    </p>
                    <ul>
                        <li><b>O domínio</b>, onde o grupo define uma identidade devido a um interesse em comum. Os membros possuem um compromisso com o domínio e suas competências compartilhadas os distinguem de outras pessoas;</li>
                        <li><b>A comunidade</b>, onde os membros do grupo se engajam em atividades e discussões conjuntas, criando relações que os permitem aprender uns com os outros e compartilhar informações;</li>
                        <li><b>A prática</b>, já que os membros são também praticantes. Eles desenvolvem em conjunto um repertório compartilhado: “[...] experiências,  histórias,  ferramentas,  maneiras  de  tratar problemas  recorrentes,  em  suma,  uma  prática  compartilhada.”</li>
                    </ul>
                    <br>

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/gVTkpEvT_9k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    <hr>
                    <h2>
                        <i>Net Promoter Score</i> (NPS)
                    </h2>
                    <p>
                    É uma métrica que tem como objetivo medir a satisfação e lealdade de um cliente com uma empresa ou um produto. No caso, o produto seria cada reunião feita por uma comunidade específica. O NPS de uma comunidade será a média do NPS de suas reuniões
                    </p><p>
                    A pontuação do NPS terá uma variação entre <b>[-100,100]</b> e poderá ser classificada em:
                    </p>
                    <ul>
                        <li><b>Zona de Excelência (Entre 75 e 100):</b> Essa pontuação é atingida quando é gerada uma grande experiência para o usuário. Houve dela uma percepção positiva o que, consequentemente, pode trazer boas recomendações e torná-lo um defensor da comunidade;</li>
                        <li><b>Zona de Qualidade (Entre 50 e 74):</b> Nesta faixa de avaliação, certamente foram vistos vários pontos positivos durante a experiência com a comunidade, porém alguns pontos deixaram a desejar;</li>
                        <li><b>Zona de Aperfeiçoamento (Entre 0 e 49):</b> A experiência que está avaliada nesta faixa normalmente tem pontos importantes de ajustes;</li>
                        <li><b>Zona Crítica (Entre -100 e -1):</b> Nestes casos a experiência foi altamente frustrante para o usuário e ele pode chegar a denegrir a imagem da comunidade com outras pessoas.</li>
                    </ul>
        
                </div>
                <br>
                
            
            </div>
