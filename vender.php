<?php
    require './model/conexao.php';
    if(isset($_SESSION['idFuncionario']) && !empty($_SESSION['idFuncionario'])):
    require_once 'model/venda.php';
    $objVenda = new Venda();
    require_once 'model/sessao.php';
    $objSessao = new Sessao();
    require_once 'model/filme.php';
    $objSessaoFilme = new Filme();
    require_once 'model/preco.php';
    $objSessaoIngresso = new Preco();
    require_once 'model/sala.php';
    $objSessaoSala = new Sala();
    require_once 'model/funcionario.php';
    $objFuncionario = new Funcionario();
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
    <title>CineMail - Realizar Venda</title>
</head>

<body>
    <header>
        <a href="index.html" class="logo">
            <img src="img/logo.svg" alt="Logo do CineM@ail">
            <h1 alt="CineMail">CineM@il</h1>
        </a>
        <nav class="menu">
            <button onclick="openMenu()" data-menu="button" aria-expanded="false" aria-controls="menu">Menu</button>
            <ul data-menu="list" id="menu">
                <li class="btn"> <a href="./control/ctr-logout.php">Logout</a> </li>
                <li ><a href="acesso-adm.php"><img  id="engrenagem-acesso-adm" onmouseover="passaCursor();" onmouseout="retiraCursor();" src="./img/engrenagem.svg" alt="Acesso administrativo"></a></li>
            </ul>
        </nav>
    </header>

    <main class="sessao-container">
            <div class="header-gerenciar">
                <h2>Realizar Venda</h2>
                <button onclick="action('#')" type="button" class="btnAdicionar" style="width: 150px;">Gerenciar</button>
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
            <tbody>
            <?php
                $sql = "SELECT * FROM sessao";
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
                        <td><?php echo ($objSessao['data'])?></td>                        
                        <td><?php echo ($objSessao['horarioInicio'])?>
                        <span> | </span>
                        <?php echo ($objSessao['horarioFim'])?>
                        </td>  
                        <td>
                        <?php 
                            $id = $objSessao['id_ingresso'];
                            $sqlIngresso = "SELECT valor FROM ingresso WHERE id = $id";
                            $stmtIngresso = $objSessaoIngresso->runQuery($sqlIngresso);
                            $stmtIngresso->execute();
                            $resultado = $stmtIngresso->fetch(PDO::FETCH_ASSOC);
                            echo ("R$ ".$resultado['valor']);
                        ?>
                        </td>
                        <td><button 
                        type="button" class="btnDeletar"
                        data-toggle="modal" 
                        onclick="action('#modal-vender')"
                        data-id-func="<?php echo($_SESSION['idFuncionario'])?>"
                        >
                        Vender</button>
                        </td> 
                </tr>                    
                <?php   
                 }
                ?>
            </tbody>  
        </table>
    </main>

        <!-- MODAL VENDER/COMPRAR -->

        <div class="modal" id="modal-vender">
        <div class="modal-container">
            <img onclick="fechar('#modal-vender')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
            <h3>Vender Ingresso</h3>
            <form action="control/ctr-funcionario.php" method="POST"><!--Adicionado pra enviar os dados de login pra fazer a conexão-->
                <input type="hidden" name="cadastrarVenda">
                <div class="compra-left">
                    <div class="compra-input">
                        <label for="filme">Filme</label>
                        <input type="text" name="filme" id="recipient-filme" readonly>
                    </div>

                    <div class="compra-valor">
                        <div class="compra-input">
                            <label for="valorInteiro">Valor <br><span>(Inteiro)</span></label>
                            <input type="number" name="valorInteiro" placeholder="R$ 10" readonly>
                        </div>
                        <div class="compra-input">
                            <label for="valorMeia">Valor <br><span>(Meia)</span></label>
                            <input type="number" name="valorMeia" placeholder="R$ 10" readonly>
                        </div>
                    </div>

                    <div class="compra-input">
                        <label for="funcionario">Funcionario</label>
                        <input type="text" id="recipient-funcionario" name="funcionario" readonly>
                    </div>

                    <div class="compra-input">
                        <label for="qtdInteiro">Assentos <br> Disponíveis</label>
                        <input type="number" name="qtdAssentos" id="assentos" readonly>
                    </div>
                </div>

                <div class="compra-right">
                    <div class="compra-input">
                        <label for="filme">Sessão</label>
                        <input type="text" name="sessao" id="recipient-sessao" readonly>
                    </div>

                    <div class="compra-qtd">
                        <div class="compra-input">
                            <label for="qtdInteiro">Qtd. ingr. <span>(Inteiro)</span></label>
                            <input type="number" name="qtdInteiro" >
                        </div>
                        <div class="compra-input">
                            <label for="qtdMeia">Qtd. ingr. <br><span>(Meia)</span></label>
                            <input type="number" name="qtdMeia">
                        </div>
                    </div>

                    <div class="compra-input">
                        <label for="cliente">CPF <span>Cliente</span></label>
                        <input type="text" name="cpfCliente">
                    </div>
                </div>
            </form>
            <div class="forget-enviar"><!--Criada pra alinhar os elementos abaixo-->
                <button class="enviar" type="submit" value="Enviar"><a href="./sessao.html">Próximo</a></button>
            </div>
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
    <script src="./js/owl/jquery.min.js"></script>
    <script src="./js/owl/owl.carousel.min.js"></script>
    <script src="./js/owl/setup.js"></script>
    <script src="./js/hover.js"></script>

    <!-- SCRIPT PARA EDITAR SALA -->
    <script>
        $("#modal-vender").on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            // var recipientId = button.data('id');
            //var recipiendIdFunc = button.data('id-func');
            var recipientFuncionario = button.data('id-func');
            
            var modal = $(this)
            // modal.find('#recipient-id').val(recipientId);
            modal.find('#recipient-funcionario').val(recipientFuncionario);
        })
    </script>
</body>

</html>

<?php
    else: header("Location: ../projetoCinema/index.html"); endif;
?>