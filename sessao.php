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

    <title>CineMail</title>
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
                <li><a href="./control/ctr-logout.php">Logout</a></li>
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
                $idSala = $id['id_sala'];

                $sqlSala = "SELECT nome FROM sala WHERE id = $idSala";
                $stmtSala = $obj->runQuery($sqlSala);
                $stmtSala->execute();
                $resultado = $stmtSala->fetch(PDO::FETCH_ASSOC); 
                echo ($resultado['nome']);
                ?>
                </span> </p>
                <p>Total: R$ <span id="total"><?php
                    $id = $_GET['cliente'];
                    $sessao = $_GET['sessao'];
                    $qtdInt = $_GET['qtdInt'];
                    $qtdMeia = $_GET['qtdMeia'];
                    $sqlTotal = "SELECT valorTotal FROM venda WHERE id_cliente = $id AND id_sessao = $sessao AND qtdIngrInt = $qtdInt AND qtdIngrMeia = $qtdMeia ORDER BY id DESC LIMIT 1";
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
                        <button class="btn-vermelho">Voltar</button>
                    </a>
                    <!-- <button class="btn-vermelho">Cancelar</button> -->
                </div>
    
                <div class="sala-cinema">
                    <ul class="assentos"><?php 
                        $sql = "SELECT qtdAssentos FROM sala WHERE id = $idSala";
                        $obj = new Sessao();
                        $stmt = $obj->runQuery($sql);
                        $stmt->execute();
                        $qtd = $stmt->fetch(PDO::FETCH_ASSOC); 
                        $qtd = $qtd['qtdAssentos'];
                        $qtd;
                        for($i = 1;$i<=$qtd;$i++){?>
                            <li>
                                <svg class="cadeira" width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                    <path d="M33.2176 14.3328C31.96 14.3328 30.9407 15.3783 30.9407 16.668V27.9252H8.01992V16.668C8.01992 15.3783 7.0005 14.3328 5.74305 14.3328C4.48553 14.3328 3.46619 15.3783 3.46619 16.668V33.8256C3.46619 34.7039 3.93917 35.4686 4.63796 35.8673V39.3099H6.84815V36.1609H32.1125V39.3099H34.3227V35.8673C35.0215 35.4686 35.4945 34.7039 35.4945 33.8256V16.668C35.4944 15.3783 34.475 14.3328 33.2176 14.3328Z" fill="#C4C4C4"/>
                                    <path d="M10.2301 22.1211H28.7305V25.6582H10.2301V22.1211Z" fill="#C4C4C4"/>
                                    <path d="M10.23 16.668V19.8543H28.7305V16.668C28.7305 14.1304 30.7433 12.0659 33.2175 12.0659V2.95732C33.2175 1.66762 32.1981 0.62207 30.9406 0.62207H8.01986C6.76233 0.62207 5.74292 1.66762 5.74292 2.95732V12.0658C8.21715 12.0659 10.23 14.1304 10.23 16.668Z" fill="#C4C4C4"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0">
                                    <rect width="37.7206" height="38.6878" fill="white" transform="translate(0.619995 0.62207)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="tela">Tela do Cinema</div>
                </div>
    
                <div class="section-confirmar">
                    <div id="assentos-selecionados">
                        <p>Qtd. de Assentos <br> Selecionados:</p>
                        <div>0/<?php
                            echo($_GET['qtdInt']+$_GET['qtdMeia']);
                        ?></div>
                    </div>
    
                    <button onclick="imprimirIngresso()" class="btn-amarelo">Confirmar</button>
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
    
    <script>
        function imprimirIngresso(){
            const nomeFilme = document.querySelector('#filme').innerHTML;
            const nomeSala = document.querySelector('#sala').innerHTML;
            const dataSessao = document.querySelector('#data').innerHTML;
            const horario = document.querySelector('#horario').innerHTML;
            const qtdInt = document.querySelector('#qtdInteiro').innerHTML;
            const qtdMeia = document.querySelector('#qtdMeia').innerHTML;
            var janela = window.open('','','width=200, heigth=300');
            janela.document.write('<html><head>');
            janela.document.write('<title>Ingresso Cinem@il</title></head>');
            janela.document.write('<body>');
            janela.document.write('<h1>Ingresso Cinem@il</h1>');
            janela.document.write('<p>Filme: '+nomeFilme+'</p>');
            janela.document.write('<p>Sala: '+nomeSala+'</p>');
            janela.document.write('<p>Data: '+dataSessao+'</p>');
            janela.document.write('<p>Horário: '+horario+'</p>');
            janela.document.write('<p>Quantidade de Ingressos (Int.): '+qtdInt+'</p>');
            janela.document.write('<p>Quantidade de Ingressos (Meia): '+qtdMeia+'</p>');
            janela.document.write('</body></html>');
            janela.document.close();
            janela.print();
        }
    </script>

    <!--Linkando com arquivo JS-->
    <script src="./js/script.js"></script>
    <script src="./js/owl/jquery.min.js"></script>
    <script src="./js/owl/owl.carousel.min.js"></script>
    <script src="./js/owl/setup.js"></script>
    <script src="./js/hover.js"></script>
</body>

</html>

<?php
    else: header("Location: ../projetoCinema/index.php"); endif;
?>