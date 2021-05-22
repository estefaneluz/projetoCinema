<?php
    require './model/conexao.php';
    if(isset($_SESSION['idFuncionario']) && !empty($_SESSION['idFuncionario'])):
        require_once 'model/sessao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/responsivo.css">
    <link rel="stylesheet" href="./css/sessao.css">
    <!-- FONTES DO GOOGLE  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

    <!--OWL CSS-->
    <link rel="stylesheet" href="./css/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl/owl.theme.default.min.css">
    <title>CineMail</title>
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
                <li class="btn"> Logout </li>
                <li ><a href="acesso-adm.php"><img  id="engrenagem-acesso-adm" onmouseover="passaCursor();" onmouseout="retiraCursor();" src="./img/engrenagem.svg" alt="Acesso administrativo"></a></li>
            </ul>
        </nav>
    </header>

    <main class="sessao-container">
            <p>Filme: 
                <span id="filme"><?php
                $id = $_GET['sessao'];
                $sqlId = "SELECT id_filme FROM sessao WHERE id = $id";
                $obj = new Sessao();
                $stmtId = $obj->runQuery($sqlId);
                $stmtId->execute();
                $id = $stmtId->fetch(PDO::FETCH_ASSOC); 
                $id = $id['id_filme'];

                $sqlFilme = "SELECT nome FROM filme WHERE id = $id";
                $stmtFilme = $obj->runQuery($sqlFilme);
                $stmtFilme->execute();
                $resultado = $stmtFilme->fetch(PDO::FETCH_ASSOC); 
                echo ($resultado['nome']);
                ?></span>
            </p>
            <div class="sessao-info">
                <p>Qtd. Ingressos <span class="mini">(Inteiro)</span>: 
                <span id="qtdInteiro"><?php
                    echo($_GET['qtdInt']);
                ?></span></p>
                <p>Qtd. Ingressos <span class="mini">(Meia)</span>: <span id="qtdMeia"><?php
                    echo($_GET['qtdMeia']);
                ?></span></p>
                <p>Data: 
                    <span id="data"><?php
                    $id = $_GET['sessao'];
                    $sql = "SELECT data FROM sessao WHERE id = $id";
                    $obj = new Sessao();
                    $stmt = $obj->runQuery($sql);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC); 
                    echo date('d/m/Y', strtotime($resultado['data']));
                    ?></span>
                </p>
                <p>Horário: <span id="horario"><?php
                    $id = $_GET['sessao'];
                    $sql = "SELECT horarioInicio FROM sessao WHERE id = $id";
                    $obj = new Sessao();
                    $stmt = $obj->runQuery($sql);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC); 
                    echo date('H:i', strtotime($resultado['horarioInicio']));
                ?></span>
                </p>
                <p>Sala: <span id="sala"><?php
                $id = $_GET['sessao'];
                $sql = "SELECT id_sala FROM sessao WHERE id = $id";
                $obj = new Sessao();
                $stmt = $obj->runQuery($sql);
                $stmt->execute();
                $id = $stmt->fetch(PDO::FETCH_ASSOC); 
                $id = $id['id_sala'];

                $sqlSala = "SELECT nome FROM sala WHERE id = $id";
                $stmtSala = $obj->runQuery($sqlSala);
                $stmtSala->execute();
                $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC); 
                echo ($resultado['nome']);
                ?>
                </span> </p>
                <p>Total: R$ <span id="total"><?php
                    $id = $_GET['cliente'];
                    $sessao = $_GET['sessao'];
                    $sqlTotal = "SELECT valorTotal FROM venda WHERE id_cliente = $id AND id_sessao = $sessao";
                    $obj = new Sessao();
                    $stmtTotal = $obj->runQuery($sqlTotal);
                    $stmtTotal->execute();
                    $valorTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC); 
                    echo ($valorTotal['valorTotal']);
                ?></span></p>
            </div>

            <div class="section-controle">
                <div class="botoes">
                    <a href="./vender.php">
                        <button class="btn-cinza">Voltar</button>
                    </a>
                    <button class="btn-vermelho">Cancelar</button>
                </div>
    
                <div>
                    <div class="tela">Tela do Cinema</div>
                </div>
    
                <div class="section-confirmar">
                    <div id="assentos-selecionados">
                        <p>Qtd. de Assentos <br> Selecionados:</p>
                        <div>2/<?php
                            echo($_GET['qtdInt']+$_GET['qtdMeia']);
                        ?></div>
                    </div>
    
                    <button class="btn-amarelo">Confirmar</button>
                </div>
            </div>
    </main>

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
</body>

</html>

<?php
    else: header("Location: ../projetoCinema/index.html"); endif;
?>