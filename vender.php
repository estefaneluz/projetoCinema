<?php
    require './model/conexao.php';
    if(isset($_SESSION['idFuncionario']) && !empty($_SESSION['idFuncionario'])):
    require_once 'model/venda.php';
    $objVenda = new Venda();
    require_once 'model/sessao.php';
    $objSessao = new Sessao();
    require_once 'model/filme.php';
    $objSessaoFilme = new Filme();
    $objData = new Filme();
    require_once 'model/preco.php';
    $objSessaoIngresso = new Preco();
    require_once 'model/sala.php';
    $objSessaoSala = new Sala();
    require_once 'model/funcionario.php';
    require_once 'model/cliente.php';
    $objFunc = new Funcionario();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/responsivo.css">
    <link rel="stylesheet" type="text/css" href="./css/sessao.css">
    <link rel="stylesheet" type="text/css" href="./css/style-acesso-adm.css">

    <!-- FONTES DO GOOGLE  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

    <!--OWL CSS-->
    <link rel="stylesheet" href="./css/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl/owl.theme.default.min.css">
    <!--SCRIPTS jQuery PARA MANIPULAR EDIÇÃO-->
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>CineMail - Realizar Venda</title>
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <img src="img/logo.svg" alt="Logo do CineM@ail">
            <h1 alt="CineMail">CineM@il</h1>
        </a>
        <nav class="menu">
            <button onclick="openMenu()" data-menu="button" aria-expanded="false" aria-controls="menu">Menu</button>
            <ul data-menu="list" id="menu">
                <li><p>Olá, <?php  
                        $id = $_SESSION['idFuncionario'];
                        $sqlFunc = "SELECT nome FROM funcionario WHERE id = $id";
                        $stmtFunc = $objFunc->runQuery($sqlFunc);
                        $stmtFunc->execute();
                        $resultado = $stmtFunc->fetch(PDO::FETCH_ASSOC);
                        echo ($resultado['nome']); ?></p></li>
                <li > <a href="./control/ctr-logout.php">Logout</a> </li>
                <li ><a href="acesso-adm.php"><img  id="engrenagem-acesso-adm" onmouseover="passaCursor();" onmouseout="retiraCursor();" src="./img/engrenagem.svg" alt="Acesso administrativo"></a></li>
            </ul>
        </nav>
    </header>

    <main class="sessao-container" id="realizar-vendas">
        <div class="header-gerenciar">
            <h2>Realizar Venda</h2>
            <button onclick="sumirContainer()" type="button" class="btnAdicionar" style="width: 150px;">Relatório</button>
        </div>
        <div class="pesquisar">
            <input type="text"  class="inputPesquisar" id="pesquisarSessao" placeholder="Pesquisar...">
        </div>
        <table class="tabela">
            <thead>
                <tr>
                    <th>Filme</th>
                    <th>Sala</th>
                    <th>Data</th> 
                    <th>Horário</th>                       
                    <th>Preço</th>
                    <th>Vender</th>
                </tr>
            </thead>
            <tbody id="tabelaSessao">
            <?php
                $sql = "SELECT * FROM sessao WHERE status = 'LIVRE'";
                $stmt = $objSessao->runQuery($sql);
                $stmt->execute();
                while($objSessao = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>       
                <tr>
                    <td>
                        <?php
                            $id = $objSessao['id_filme'];
                            $sqlFilme = "SELECT nome FROM filme WHERE id = $id";
                            $stmtFilme = $objSessaoFilme->runQuery($sqlFilme);
                            $stmtFilme->execute();
                            $resultado = $stmtFilme->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                            ?>
                        </td>
                        <td>
                        <?php 
                            $id = $objSessao['id_sala'];
                            $sqlSala = "SELECT nome FROM sala WHERE id = $id";
                            $stmtSala = $objSessaoSala->runQuery($sqlSala);
                            $stmtSala->execute();
                            $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>
                        </td> 
                        <td><?php echo $objData->converterData($objSessao['data'])?></td>                        
                        <td><?php echo date('H:i', strtotime($objSessao['horarioInicio']))?>
                        <span> | </span>
                        <?php echo date('H:i', strtotime($objSessao['horarioFim']))?>
                        </td>  
                        <td>
                        <?php 
                            $id = $objSessao['id_ingresso'];
                            $sqlIngresso = "SELECT valor, meia FROM ingresso WHERE id = $id";
                            $objIngresso = new Preco();
                            $stmtIngresso = $objIngresso->runQuery($sqlIngresso);
                            $stmtIngresso->execute();
                            while($objIngresso = $stmtIngresso->fetch(PDO::FETCH_ASSOC)){
                            $resultado = $stmtIngresso->fetch(PDO::FETCH_ASSOC);
                            echo ("R$ ".$objIngresso['valor']." / R$ ".$objIngresso['meia']);
                            }
                        ?>
                        </td>
                        <td>
                        <button type="button" class="btnDeletar"
                        data-toggle="modal"
                        data-target="#modal-vender"
                        data-sessao="<?php print $objSessao['id']?>"
                        data-id-filme="<?php print $objSessao['id_filme']?>"
                        data-filme="
                        <?php 
                            $id = $objSessao['id_filme'];
                            $sqlFilme = "SELECT nome FROM filme WHERE id = $id";
                            $stmtFilme = $objSessaoFilme->runQuery($sqlFilme);
                            $stmtFilme->execute();
                            $resultado = $stmtFilme->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>"
                        data-func="<?php
                            $id = $_SESSION['idFuncionario'];
                            $sqlFunc = "SELECT nome FROM funcionario WHERE id = $id";
                            $stmtFunc = $objFunc->runQuery($sqlFunc);
                            $stmtFunc->execute();
                            $resultado = $stmtFunc->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>"
                        data-valor="<?php
                            $id = $objSessao['id_ingresso'];
                            $sqlValor = "SELECT valor FROM ingresso WHERE id = $id";
                            $stmtValor = $objSessaoIngresso->runQuery($sqlValor);
                            $stmtValor->execute();
                            $resultado = $stmtValor->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['valor']);
                        ?>"
                        data-meia="<?php
                            $id = $objSessao['id_ingresso'];
                            $sqlValor = "SELECT meia FROM ingresso WHERE id = $id";
                            $stmtValor = $objSessaoIngresso->runQuery($sqlValor);
                            $stmtValor->execute();
                            $resultado = $stmtValor->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['meia']);
                        ?>"
                        data-sala="<?php
                            $id = $objSessao['id_sala'];
                            $sqlSala = "SELECT nome FROM sala WHERE id = $id";
                            $stmtSala = $objSessaoSala->runQuery($sqlSala);
                            $stmtSala->execute();
                            $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>"
                        data-hr-inicio="<?php echo($objSessao['horarioInicio']);?>"
                        data-hr-fim="<?php echo($objSessao['horarioFim']);?>"
                        data-assentos="<?php
                            $obj = new Venda();
                            $qtdAssentos = $obj->getQtdAssentos($objSessao['id']);
                            $ingrVendidos = $obj->getIngrVendidos($objSessao['id']);
                            $assentosDisponiveis = $qtdAssentos - $ingrVendidos;
                            echo ($assentosDisponiveis); 
                        ?>">
                        Vender</button>
                        </td> 
                    </tr>                    
                    <?php   
                    }
                    ?>
            </tbody>  
        </table>
    </main>

    <section id="relatorio-vendas" class="sessao-container">
        <div class="header-gerenciar">
            <h2>Vendas Realizadas</h2>
            <button onclick="sumirContainer()" type="button" class="btnAdicionar" style="width: 150px;">Vender</button>
        </div>
        <div class="pesquisar">
            <input type="text"  class="inputPesquisar" id="pesquisarVenda" placeholder="Pesquisar...">
        </div>
        <table class="tabela">
            <thead>
                <tr>
                    <th>Data / Hora</th>
                    <th>Funcionário</th>
                    <th>Cliente</th> 
                    <th>Qtd. Ingressos</th>                       
                    <th>Total</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody id="tabelaRelatorio">
            <?php
                $sql = "SELECT * FROM venda";
                $stmt = $objVenda->runQuery($sql);
                $stmt->execute();
                while($objVenda = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>       
                    <tr>
                    <td>
                        <?php
                            echo date('d/m/Y H:i:s',strtotime($objVenda['data']));
                        ?>
                    </td>
                    <td>
                        <?php
                            $id = $objVenda['id_func'];
                            $sqlFuncionario = "SELECT nome FROM funcionario WHERE id = $id";
                            $objFuncionario = new Funcionario();
                            $stmtFuncionario = $objFuncionario->runQuery($sqlFuncionario);
                            $stmtFuncionario->execute();
                            $resultado = $stmtFuncionario->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>
                    </td>
                    <td>
                        <?php
                            $id = $objVenda['id_cliente'];
                            $sqlCliente = "SELECT nome FROM cliente WHERE id = $id";
                            $objCliente = new Cliente();
                            $stmtCliente = $objCliente->runQuery($sqlCliente);
                            $stmtCliente->execute();
                            $resultado = $stmtCliente->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>
                    </td>
                    <td>
                        <?php 
                            echo ($objVenda['qtdIngrInt']+$objVenda['qtdIngrMeia']);
                        ?>
                    </td> 
                    <td><?php echo ("R$ ".$objVenda['valorTotal'])?></td>                        
                    <td>
                        <button type="button" class="btnEditar"
                        data-toggle="modal"
                        data-target="#modal-editar"
                        data-venda="<?php print $objVenda['id']?>"
                        data-sessao="<?php print $objVenda['id_sessao']?>"
                        data-id-cliente="<?php print $objVenda['id_cliente'];?>"
                        data-qtd-int="<?php print $objVenda['qtdIngrInt']?>"
                        data-qtd-meia="<?php print $objVenda['qtdIngrMeia']?>"
                        data-filme="<?php
                            $id = $objVenda['id_sessao'];
                            $sqlFilme = "SELECT id_filme FROM sessao WHERE id = $id";
                            $obj = new Sessao();
                            $stmtFilme = $obj->runQuery($sqlFilme);
                            $stmtFilme->execute();
                            $resultado = $stmtFilme->fetch(PDO::FETCH_ASSOC);

                            $id = $resultado['id_filme']; 
                            $sqlFilme = "SELECT nome FROM filme WHERE id = $id";
                            $obj = new Sessao();
                            $stmtFilme = $obj->runQuery($sqlFilme);
                            $stmtFilme->execute();
                            $resultado = $stmtFilme->fetch(PDO::FETCH_ASSOC);
                            echo ($resultado['nome']);
                        ?>"
                        data-valor-int="<?php
                            $id = $objVenda['id_sessao'];
                            $sqlPreco = "SELECT id_ingresso FROM sessao WHERE id = $id";
                            $obj = new Sessao();
                            $stmtPreco = $obj->runQuery($sqlPreco);
                            $stmtPreco->execute();
                            $resultado = $stmtPreco->fetch(PDO::FETCH_ASSOC);

                            $id = $resultado['id_ingresso']; 
                            $sqlPreco = "SELECT valor, meia FROM ingresso WHERE id = $id";
                            $obj = new Sessao();
                            $stmtPreco = $obj->runQuery($sqlPreco);
                            $stmtPreco->execute();
                            $resultado = $stmtPreco->fetch(PDO::FETCH_ASSOC);
                            echo ("R$ ".$resultado['valor']);
                        ?>"
                        data-valor-meia="<?php
                            echo ("R$ ".$resultado['meia']);
                        ?>"
                        data-sala="<?php
                            $sqlSala= "SELECT id_sala FROM sessao WHERE id = $id";
                            $obj = new Sessao();
                            $stmtSala= $obj->runQuery($sqlSala);
                            $stmtSala->execute();
                            $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC);

                            $id = $resultado['id_sala'];
                            $sqlSala= "SELECT nome, qtdAssentos FROM sala WHERE id = $id";
                            $obj = new Sessao();
                            $stmtSala= $obj->runQuery($sqlSala);
                            $stmtSala->execute();
                            $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC);

                            echo ($resultado['nome']);
                        ?>"
                        data-assentos="<?php
                            $qtdAssentos = $resultado['qtdAssentos'];
                            $id = $objVenda['id_sessao'];
                            $sqlSala= "SELECT ingressosVendidos FROM sessao WHERE id = $id";
                            $obj = new Sessao();
                            $stmtSala= $obj->runQuery($sqlSala);
                            $stmtSala->execute();
                            $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC);
                            echo($qtdAssentos-$resultado['ingressosVendidos']);
                        ?>"
                        data-hr-inicio="<?php
                            $id = $objVenda['id_sessao'];
                            $sqlHr = "SELECT horarioInicio, horarioFim FROM sessao WHERE id = $id";
                            $obj = new Sessao();
                            $stmtHr = $obj->runQuery($sqlHr);
                            $stmtHr->execute();
                            $resultado = $stmtHr->fetch(PDO::FETCH_ASSOC);
                            echo date('H:i', strtotime($resultado['horarioInicio']));
                        ?>"
                        data-hr-fim="<?php
                            echo date('H:i', strtotime($resultado['horarioFim']));
                        ?>"
                        data-funcionario="<?php
                            $id = $objVenda['id_func'];
                            $sqlNome = "SELECT nome FROM funcionario WHERE id = $id";
                            $obj = new Sessao();
                            $stmtNome = $obj->runQuery($sqlNome);
                            $stmtNome->execute();
                            $resultado = $stmtNome->fetch(PDO::FETCH_ASSOC);
                            echo($resultado['nome']);
                        ?>"
                        data-cliente="<?php
                            $id = $objVenda['id_cliente'];
                            $sqlCliente = "SELECT nome FROM cliente WHERE id = $id";
                            $obj = new Sessao();
                            $stmtCliente = $obj->runQuery($sqlCliente);
                            $stmtCliente->execute();
                            $resultado = $stmtCliente->fetch(PDO::FETCH_ASSOC);
                            echo($resultado['nome']);
                        ?>"
                        >
                        Editar</button>
                    </td> 
                    </tr>                    
                <?php   
                }
                ?>
            </tbody>
        </table>
    </section>

        <!-- MODAL VENDER/COMPRAR -->

        <div class="modal" id="modal-vender">
        <div class="modal-container">
            <img onclick="fechar('#modal-vender')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
            <h3>Vender Ingresso</h3>
            <form action="./control/ctr-venda.php" method="GET">
                <input type="hidden" name="idSessao" id="recipient-sessao">
                <div class="compra-left">
                    <div class="compra-input">
                        <label for="filme">Filme</label>
                        <input type="text" name="filme" id="recipient-filme" readonly>
                    </div>

                    <div class="compra-valor">
                        <div class="compra-input">
                            <label for="valorInteiro">Valor <br><span>(Inteiro)</span></label>
                            <input type="text" name="valorInteiro" id="valorInteiro" readonly>
                        </div>
                        <div class="compra-input">
                            <label for="valorMeia">Valor <br><span>(Meia)</span></label>
                            <input type="text" name="valorMeia" id="valorMeia" readonly>
                        </div>
                    </div>

                    <div class="compra-input">
                        <label for="funcionario">Funcionário</label>
                        <input type="text" id="nome-funcionario" name="funcionario" readonly>
                    </div>

                    <div class="compra-input">
                        <label for="qtdInteiro">Assentos <br> Disponíveis</label>
                        <input type="number" name="qtdAssentos" id="assentos" readonly>
                    </div>
                </div>

                <div class="compra-right">
                    <div class="compra-input">
                        <label for="filme">Sala e Horário</label>
                        <input type="text" name="sessao" id="recipient-sala-hr" readonly>
                    </div>

                    <div class="compra-qtd">
                        <div class="compra-input">
                            <label for="qtdInteiro">Qtd. ingr. <span>(Inteiro)</span></label>
                            <input type="number" name="qtdInteiro" min="0">
                        </div>
                        <div class="compra-input">
                            <label for="qtdMeia">Qtd. ingr. <br><span>(Meia)</span></label>
                            <input type="number" name="qtdMeia" min="0">
                        </div>
                    </div>

                    <div class="compra-input">
                        <label for="cliente">CPF <span>Cliente</span></label>
                        <input type="text" name="cpfCliente">
                    </div>
                    <div class="compra-input">
                        <label for="cliente">Data atual</span></label>
                        <input type="text" name="dataAtual" id="dataAtual" readonly>
                    </div>
                    <div class="forget-enviar"><br>
                    <button class="enviar" type="submit" value="Enviar">Próximo</button>
                    </div>
                </div>
            </form>
        </div>
        </div>

        <!-- Modal editar -->
        <div class="modal" id="modal-editar">
        <div class="modal-container">
            <img onclick="fechar('#modal-editar')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
            <h3>Editar Ingresso</h3>
            <form action="./control/ctr-venda.php" method="GET">
                <input type="hidden" name="idVenda" id="editar-venda">
                <input type="hidden" name="idSessao" id="editar-sessao">
                <input type="hidden" name="idCliente" id="id-cliente">

                <div class="compra-left">
                    <div class="compra-input">
                        <label for="filme">Filme</label>
                        <input type="text" name="filme" id="editar-filme" readonly>
                    </div>

                    <div class="compra-valor">
                        <div class="compra-input">
                            <label for="valorInteiro">Valor <br><span>(Inteiro)</span></label>
                            <input type="text" name="valorInteiro" id="editar-valor-int" readonly>
                        </div>
                        <div class="compra-input">
                            <label for="valorMeia">Valor <br><span>(Meia)</span></label>
                            <input type="text" name="valorMeia" id="editar-valor-meia" readonly>
                        </div>
                    </div>

                    <div class="compra-input">
                        <label for="funcionario">Funcionário</label>
                        <input type="text" id="editar-funcionario" name="funcionario" readonly>
                    </div>

                    <div class="compra-input">
                        <label for="qtdInteiro">Assentos <br> Disponíveis</label>
                        <input type="number" name="qtdAssentos" id="editar-assentos" readonly>
                    </div>
                </div>

                <div class="compra-right">
                    <div class="compra-input">
                        <label for="filme">Sala e Horário</label>
                        <input type="text" name="sessao" id="editar-sala-hr" readonly>
                    </div>

                    <div class="compra-qtd">
                        <div class="compra-input">
                            <label for="qtdInteiro">Qtd. ingr. <span>(Inteiro)</span></label>
                            <input type="number" name="qtdInteiro" min="0" id="editar-qtd-int">
                        </div>
                        <div class="compra-input">
                            <label for="qtdMeia">Qtd. ingr. <br><span>(Meia)</span></label>
                            <input type="number" name="qtdMeia" min="0" id="editar-qtd-meia">
                        </div>
                    </div>

                    <div class="compra-input">
                        <label for="cliente">Nome <span>Cliente</span></label>
                        <input type="text" id="editar-cliente" name="cliente" readonly>
                    </div>
                    <div class="compra-input">
                        <label for="cliente">Data atual</span></label>
                        <input type="text" name="dataAtual" id="editar-data" readonly>
                    </div>
                    <div class="forget-enviar"><br>
                        <button class="enviar" type="submit" value="Enviar">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
        </div>

    <footer id="contato">
        <div class="contatos-container">
            <div class='redes-sociais'>
                <h2>Redes Sociais</h2>
                <ul>
                    <li> <!--id="facebook" onmouseover="passaCursor();" onmouseout="retiraCursor();"-->
                        <a href="facebook.com" target="_blank"><img src="./img/redes-sociais/facebook.svg" alt="Facebook CineMail"></a>
                    </li>
                    <li>
                        <a href="instagram.com" target="_blank"><img src="./img/redes-sociais/instagram.svg" alt="Instagram CineMail"></a>
                    </li>
                    <li>
                        <a href="twitter.com" target="_blank"><img src="./img/redes-sociais/twitter.svg" alt="Twitter CineMail"></a>
                    </li>
                </ul>
            </div>
            <div class="contato">
                <h2>Contato</h2>
                <ul>
                    <li>+55 71 911 111 111</li>
                    <li><a href="mailto:cinemail@email.com">cinemail@email.com</a></li>
                    <li>Av. Luz Sobral, 2 - Dendezeiros</li>
                    <li>Salvador - BA</li>
                </ul>
            </div>
            <img id="img-footer" src="./img/img-footer.svg" alt="pessoas-assistindo">
        </div>
    </footer>

    <!--Linkando com arquivo JS-->
    <script src="./js/script.js"></script>
    <script src="./js/hover.js"></script>
    <script src="./js/vender.js"></script>

    <script>
            $(document).ready(function(){//leitura do doc 
            $("#pesquisarSessao").on("keyup", function() {//lê a tabela pelo id do myinput, quando para de digitar "keyup" pega o valor e começa a funlção,
                var value = $(this).val().toLowerCase();//atribui o valor pegado e coloca em value
                $("#tabelaSessao tr").filter(function() {//função para filtrar pelas linhas da tabela
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)//toggle - ao valor pegado vai transformar em minusculo e pegar o valor pelo indexOf e pesquisa pela linah da tabela
                });
            });
            });
    </script> 
    <script>
            $(document).ready(function(){
            $("#pesquisarVenda").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tabelaRelatorio tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            });
    </script>  
    <script>
        $("#modal-vender").on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientIdSessao = button.data('sessao');
            var recipientFilme = button.data('filme');
            var recipientFuncionario = button.data('func');
            var recipientValor = button.data('valor');
            var recipientMeia = button.data('meia');
            var recipientSala = button.data('sala');
            var recipientAssentos = button.data('assentos');

            var hrInicio = button.data('hr-inicio').split(":");
            hrInicio = hrInicio[0]+":"+hrInicio[1];
            var hrFim = button.data('hr-fim').split(":");
            hrFim = hrFim[0]+":"+hrFim[1];

            var d = new Date();
            var data = d.toLocaleDateString().split("/");
            data = data[2]+"-"+data[1]+"-"+data[0];
            var hora = d.toLocaleTimeString();
            var dataHora = data+" "+hora;

            var modal = $(this)
            modal.find('#recipient-sessao').val(recipientIdSessao);
            modal.find('#nome-funcionario').val(recipientFuncionario);
            modal.find('#recipient-filme').val(recipientFilme.trim());
            modal.find('#valorInteiro').val("R$ "+recipientValor);
            modal.find('#valorMeia').val("R$ "+recipientMeia);
            modal.find('#recipient-sala-hr').val(
                recipientSala+" das "
                +hrInicio+" às "+hrFim);
            modal.find('#dataAtual').val(dataHora);
            modal.find('#assentos').val(recipientAssentos);

        })
    </script>
    <script>
        $("#modal-editar").on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientSessao= button.data('sessao');
            var recipientVenda= button.data('venda');
            var recipientFilme= button.data('filme');
            var recipientInt= button.data('valor-int');
            var recipientMeia= button.data('valor-meia');
            var sala= button.data('sala');
            var hrInicio= button.data('hr-inicio');
            var hrFim= button.data('hr-fim');
            var salaHora = sala+" das "+hrInicio+" às "+hrFim;
            var recipientFuncionario= button.data('funcionario');
            var recipientCliente= button.data('cliente');
            var recipientAssentos= button.data('assentos');
            var recipientQtdInt= button.data('qtd-int');
            var recipientQtdMeia= button.data('qtd-meia');
            var recipientIdCliente= button.data('id-cliente');


            var d = new Date();
            var data = d.toLocaleDateString().split("/");
            data = data[2]+"-"+data[1]+"-"+data[0];
            var hora = d.toLocaleTimeString();
            var dataHora = data+" "+hora;

            var modal= $(this);

            modal.find("#editar-sessao").val(recipientSessao);
            modal.find("#editar-venda").val(recipientVenda);
            modal.find("#editar-filme").val(recipientFilme);
            modal.find("#editar-valor-int").val(recipientInt);
            modal.find("#editar-valor-meia").val(recipientMeia);
            modal.find("#editar-sala-hr").val(salaHora);
            modal.find("#editar-funcionario").val(recipientFuncionario);
            modal.find("#editar-cliente").val(recipientCliente);
            modal.find("#editar-assentos").val(recipientAssentos);
            modal.find("#editar-qtd-int").val(recipientQtdInt);
            modal.find("#editar-qtd-meia").val(recipientQtdMeia);
            modal.find("#editar-data").val(dataHora);
            modal.find("#id-cliente").val(recipientIdCliente);


        })
    </script>
</body>

</html>

<?php
    else: header("Location: ../projetoCinema/index.php"); endif;
?>