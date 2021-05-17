<?php
    require './model/conexao.php';
    if(isset($_SESSION['idFuncionario']) && !empty($_SESSION['idFuncionario'])):
?>

<?php
    require_once 'model/funcionario.php';
    $objFuncionario = new Funcionario(); //Criando obj q recebe as funções de funcionario

?>
<?php
    require_once 'model/cliente.php';
    $objCliente = new Cliente();
?>

<?php
    require_once 'model/sala.php';
    $objSala = new Sala();
    $objSessaoSala = new Sala();
?>

<?php
    require_once 'model/filme.php';
    $objFilme = new Filme();
    $objSessaoFilme = new Filme();
?>

<?php
    require_once 'model/preco.php';
    $objPreco = new Preco();
?>

<?php
    require_once 'model/sessao.php';
    $objSessao = new Sessao();
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/style-acesso-adm.css">
        <link rel="stylesheet" type="text/css" href="./css/responsivo.css">

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
        <title>CineMail - Acesso Administrativo</title>
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
                <li><a href="./control/ctr-logout.php">Logout</a> </li>
                <li><a href="acesso-adm.php"><img  id="engrenagem-acesso-adm" onmouseover="passaCursor();" onmouseout="retiraCursor();" src="./img/engrenagem.svg" alt="Acesso administrativo"></a></li>
            </ul>
        </nav>
    </header>
       
    <main class="acesso-adm" >
    <aside class="menu-adm">
            <nav>
                <h3>Gerenciar</h3>
                <ul>
                    <li><a href="#cadastro-filmes">filmes</a></li>
                    <li><a href="#container-sessoes">Sessões</a></li>
                    <li><a href="#container-precos">Preços</a></li>
                    <li><a href="#cadastro-salas">Salas</a></li>
                    <li><a href="#container-funcionarios">Funcionários</li>
                    <li><a href="#container-clientes">Clientes</a></li>
                </ul>
            </nav>
        </aside>

        <!-- SEÇÃO EM QUE FICARÁ TODOS OS GERENCIAR -->
        <section class="container-gerenciar">
        <!--INÍCIO DE GERENCIAR FILMES-->
        <div class="cadastro-filmes" id="cadastro-filmes">
            <div class="header-gerenciar">
                    <h2>Filmes</h2>
                    <button onclick="action('#modal-filme')" type="button" class="btnAdicionar">Novo</button>
            </div>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Estreia</th>
                        <th>Último Dia</th> 
                        <th>Class. Ind.</th>                       
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM filme";
                        $stmt = $objFilme->runQuery($sql);
                        $stmt->execute();
                        while($objFilme = $stmt->fetch(PDO::FETCH_ASSOC)){
                     ?>       
                    <tr>
                        <td><?php echo ($objFilme['nome'])?></td>
                        <td><?php echo ($objFilme['estreia'])?></td> 
                        <td><?php echo ($objFilme['ultimoDia'])?></td>                        
                        <td><?php echo ($objFilme['classIndicativa'])?></td>                                      
                        <td><button  type="button" class="btnEditar"
                                    data-toggle="modal" data-target="#modal-editar-filmes"
                                    data-id="<?php echo($objFilme['id'])?>"
                                    data-nome="<?php echo($objFilme['nome'])?>"
                                    data-estreia="<?php echo($objFilme['estreia'])?>"
                                    data-ultimoDia="<?php echo($objFilme['ultimoDia'])?>"
                                    data-duracao="<?php echo($objFilme['duracao'])?>"
                                    data-classIndicativa="<?php echo($objFilme['classIndicativa'])?>"
                                    data-genero="<?php echo($objFilme['genero'])?>"                                                      
                                >Editar
                                </button>
                        </td>
                        <td><button type="button" class="btnDeletar"
                        data-toggle="modal"
                        data-target="#modal-deletar-filmes"
                        data-id="<?php print $objFilme['id']?>"
                        data-nome="<?php print $objFilme['nome']?>"
                        >
                        Deletar</button></td>
                    </tr>                    
                    <?php   
                     }
                    ?>
                </tbody>  
            </table>
                      
            
        </div>
        <!--CADASTRAR FILME-->
        <div class="modal" id="modal-filme">
            <div class="modal-container modalFilme">
                <img onclick="fechar('#modal-filme')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Cadastrar Filme<h4>
                <form action="control/ctr-filme.php#cadastro-filmes" method="POST">
                        <input type="hidden" name="cadastrarFilme">
                        <div>
                            <label for="nome">Nome</label><br>
                            <input type="text" id="nome" name="nome" required><br>
                        </div>
                        <div>
                            <label for="estreia">Estreia</label><br>
                            <input type="date" id="estreia" name=estreia required><br> 
                        </div>
                        <div>
                            <label for="ultimoDia">Último dia</label><br>
                            <input type="date" id="ultimoDia" name="ultimoDia" required><br>                        
                        </div>
                        <div>
                            <label for="duracao">Duração</label><br>
                            <select id="duracao" name="duracao">
                                    <option value="1:00">1h:00min</option>
                                    <option value="1:30">1h:30min</option>
                                    <option value="2:00">2h:00min</option>
                                    <option value="2:30">2h:30min</option>
                                    <option value="3:00">3h:00min</option>
                            </select><br>
                        </div>
                        <div>
                            <label for="classIndicativa">Classificação Indicativa</label><br>
                            <select id="classIndicativa" name="classIndicativa">
                                    <option value="1">Livre</option><
                                    <option value="10">+10 anos</option>
                                    <option value="12">+12 anos</option>
                                    <option value="14">+14 anos</option>
                                    <option value="16">+16 anos</option>
                                    <option value="18">+18 anos</option>
                            </select><br>
                        </div>
                        <div>
                            <label for="genero">Gênero</label><br>
                            <input type="text" id="genero" name="genero" required><br>
                        </div>
                        <button type="submit" class="enviar">Enviar</button>                
                </form>
            </div>
        </div>
        <!--DELETAR FILME-->
        <div class="modal" id="modal-deletar-filmes">
            <div class="modal-container modalDeletarFilme">
                <img onclick="fechar('#modal-deletar-filmes')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">              
                <h4>Deletar Filme</h4>
                <form action="control/ctr-filme.php#cadastro-filmes" method="POST"> 
                    <input type="hidden" name="deletarFilme" id="recipient-deletarFilme">
                    <label for="recipient-deletar-nomeFilme">Nome</label>
                    <input type="text" name="txtNome" id="recipient-deletar-nomeFilme" readonly>
                    <button type="submit" class="enviar">Confirmar</button>
                </form>
            </div>        
        </div>
        <!--EDITAR FILME-->
        <div class="modal" id="modal-editar-filmes">
             <div class="modal-container modalFilme">
                 <img onclick="fechar('#modal-editar-filmes')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                 <h4>Editar Filme<h4>         
                 <form action="control/ctr-filme.php#cadastro-filmes" method="POST" >
                     <input id="recipient-idFilme" type="hidden" name="editarFilme">
                     <div>
                        <label for="recipient-nome-filme">Nome</label><br>
                        <input type="text" name="nomeFilme" id="recipient-nome-filme"><br>
                    </div>
                     <div>
                        <label for="recipient-estreia">Estreia</label><br>
                        <input type="date" name="estreiaFilme" id="recipient-estreia"><br> 
                     </div>
                     <div>
                        <label for="recipient-ultimo-dia">Último Dia</label><br>
                        <input type="date" name="ultimoDia" id="recipient-ultimo-dia"><br>
                     </div>
                     <div>
                     <label for="recipient-duracao">Duração</label><br>
                            <select name="duracao" id="recipiente-duracao">
                                    <option value="1:00">1h:00min</option>
                                    <option value="1:30">1h:30min</option>
                                    <option value="2:00">2h:00min</option>
                                    <option value="2:30">2h:30min</option>
                                    <option value="3:00">3h:00min</option>
                            </select><br>
                     </div>
                     <div>
                        <label for="recipient-class-indicativa">Classificação Indicativa</label><br>
                        <select name="classIndicativa" id="recipient-class-indicativa" >
                                    <option value="Livre">Livre</option>
                                    <option value="10">+10 anos</option>
                                    <option value="12">+12 anos</option>
                                    <option value="14">+14 anos</option>
                                    <option value="16">+16 anos</option>
                                    <option value="18">+18 anos</option>
                        </select><br>
                     </div>
                     <div>
                        <label for="recipient-genero">Gênero</label><br>
                        <input type="text" name="genero" id="recipient-genero"><br>
                     </div>
                     <button type="submit" class="enviar">Confirmar</button> 
                 </form>   
            </div>
    
        </div>
        <!--FIM DO GERENCIAMENTO DE FILMES-->

        <!-- INICIO DO GERENCIAR SESSÕES -->

        <div class="container-sessoes" id="container-sessoes">
            <div class="header-gerenciar">
                    <h2>Sessões</h2>
                    <button onclick="action('#modal-sessao')" type="button" class="btnAdicionar">Novo</button>
            </div>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Filme</th>
                        <th>Sala</th>
                        <th>Data</th> 
                        <th>Horário</th>      
                        <th>Status</th>                                        
                        <th>Edit.</th>
                        <th>Del.</th>
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
                        <td><?php 
                        echo ($objSessao['id_filme'])?>
                        </td>
                        <td><?php echo ($objSessao['id_sala'])?></td> 
                        <td><?php echo ($objSessao['data'])?></td>                        
                        <td><?php echo ($objSessao['horarioInicio'])?>
                        <span> | </span>
                        <?php echo ($objSessao['horarioFim'])?>
                        </td>  
                        <td><?php echo ($objSessao['ingressosVendidos'])?></td>                                    
                        <td><button  type="button" class="btnEditar"
                        data-toggle="modal" data-target="#modal-editar-sessao"
                        data-id="<?php print $objSessao['id']?>"
                        data-filme="<?php print $objSessao['id_filme']?>"
                        data-data="<?php print $objSessao['data']?>"
                        data-sala="<?php print $objSessao['id_sala']?>"
                        data-horario="<?php print $objSessao['horarioInicio']?>">                                                      
                                Editar
                                </button>
                        </td>
                        <td><button type="button" class="btnDeletar"
                        data-toggle="modal"
                        data-target="#modal-deletar-sessao"
                        data-id="<?php print $objSessao['id']?>"
                        data-filme="<?php print $objSessao['id_filme']?>"
                        data-data="<?php print $objSessao['data']?>"
                        data-sala="<?php print $objSessao['id_sala']?>"
                        data-horario="<?php print $objSessao['horarioInicio']?>"
                        >
                        Deletar</button></td>
                    </tr>                    
                    <?php   
                     }
                    ?>
                </tbody>
                </table>
        </div>

        <!-- CADASTRAR SESSAO -->
        <div class="modal" id="modal-sessao">
            <div class="modal-container">
                <img onclick="fechar('#modal-sessao')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Cadastrar Sessão<h4>
                <form action="control/ctr-sessao.php#container-sessoes" method="POST">
                        <input type="hidden" name="cadastrarSessao">
                        <div>
                            <label for="filme">Filme</label><br>
                            <select id="filme" name="filme">
                            <?php
                            $sql = "SELECT * FROM filme";
                            $stmt = $objSessaoFilme->runQuery($sql);
                            $stmt->execute();
                            while($objSessaoFilme = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>  
                                <option value="<?php echo($objSessaoFilme['id'])?>">
                                <?php echo ($objSessaoFilme['nome'])?></option>
                            <?php   
                            }
                            ?>
                            </select><br>
                        </div>
                        <div>
                            <label for="sala">Sala</label><br>
                            <select id="sala" name="sala">
                            <?php
                            $sql = "SELECT * FROM sala";
                            $stmt = $objSessaoSala->runQuery($sql);
                            $stmt->execute();
                            while($objSessaoSala = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>  
                                <option value="<?php echo($objSessaoSala['id'])?>">
                                <?php echo ($objSessaoSala['nome'])?></option>
                            <?php   
                            }
                            ?>
                            </select><br>
                        </div>
                        <div>
                            <label for="data">Data:</label><br>
                            <input type="date" id="data" name="data" required><br>                        
                        </div>
                        <div>
                            <label for="horarioInicio">Horário de Inicio</label><br>
                            <input type="time" id="horarioInicio" name="horarioInicio" required><br>
                        </div>
                        <button type="submit" class="enviar">Enviar</button>                
                </form>
            </div>
        </div>
        <!-- FIM CADASTRAR SESSAO -->
        <!--DELETAR SESSÃO-->
        <div class="modal" id="modal-deletar-sessao">
            <div class="modal-container">
                <img onclick="fechar('#modal-deletar-sessao')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">              
                <h4>Deletar Sessão</h4>
                <form action="control/ctr-sessao.php#container-sessoes" method="POST"> 
                    <input type="hidden" name="deletarSessao" id="recipient-deletar">
                    <div>
                        <label for="txtFilme">Filme</label><br>
                        <input type="text" name="txtFilme" id="recipient-deletar-filme" readonly>
                    </div>
                    <div>
                        <label for="txtSala">Data</label><br>
                        <input type="text" name="txtData" id="recipient-deletar-data" readonly>
                    </div>
                    <div>
                        <label for="txtSala">Sala</label><br>
                        <input type="text" name="txtSala" id="recipient-deletar-sala" readonly>
                    </div>
                    <div>
                        <label for="txtSala">Horário</label><br>
                        <input type="text" name="txtHorario" id="recipient-deletar-horario" readonly>
                    </div>
                    <button type="submit" class="enviar">Confirmar</button>
                </form>
            </div>        
        </div>
        <!-- FIM DE DELETTAR SESSAO -->
        <!--EDITAR FILME-->
        <div class="modal" id="modal-editar-sessao">
             <div class="modal-container">
                 <img onclick="fechar('#modal-editar-sessao')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                 <h4>Editar Sessão<h4> 
                 <form action="control/ctr-sessao.php#container-sessoes" method="POST" >
                     <input id="recipient-id" type="hidden" name="editarSessao">
                     <div>
                        <label for="filme">Filme</label><br>
                        <input type="text" name="filme" id="recipient-filme"><br>
                    </div>
                     <div>
                        <label for="sala">Sala</label><br>
                        <input type="text" name="sala" id="recipient-sala"><br> 
                     </div>
                     <div>
                        <label for="data">Data</label><br>
                        <input type="date" name="data" id="recipient-data"><br>
                     </div>
                     <div>
                        <label for="horario">Horário de Inicio</label><br>
                        <input type="time" name="horario" id="recipient-horario"><br>
                     </div>
                     <button type="submit" class="enviar">Confirmar</button> 
                 </form>   
            </div>
        </div>
        <!-- FIM DO GERENCIAR SESSÕES -->
        
        
        <!-- INICIO GERENCIAMENTO DE PRECOS -->
        <div id='container-precos'>
        <div class="header-gerenciar">
                <h2>Preços Ingressos</h2>
                <button onclick="action('#modal-precos')" type="button" class="btnAdicionar">Novo</button>
            </div>
             <table class="tabela">      
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor Inteiro</th>
                        <th>Meia</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
                </table>
        </div>
            <!-- MODAL DELETAR PRECOS -->
            <div class="modal" id="modal-deletar-precos">
                <div class="modal-container">
                    <img onclick="fechar('#modal-deletar-precos')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">               
                    <h4>Deletar Preço</h4>
                    <form action="control/ctr-preco.php#cadastrar-precos" method="POST"> 
                        <input type="hidden" name="deletarPreco" id="recipient-idPreco">
                        <label for="recipient-nome-preco">Nome</label>
                        <input type="text" name="nomePreco" id="recipient-nome-preco" readonly>
                        <button type="submit" class="enviar">Deletar</button>
                    </form>           
                </div>
            </div> <!-- FIM DO MODAL DELETAR PRECOS -->

            <!-- INICIO MODAL EDITAR PRECOS  -->
            <div class="modal" id="modal-editar-precos">
                <div class="modal-container" >
                    <img onclick="fechar('#modal-editar-precos')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                    <h4>Editar Preços<h4>
                    <form action="control/ctr-preco.php#container-precos" method="POST">
                            <input id="recipient-idPreco" type="hidden" name="editarPreco">
                            <div>
                                <label for="nome">Nome</label><br>
                                <input type="text" name="nome" id="recipient-nome-preco"  ><br>
                            </div>
                            
                            <div>
                                <label for="valor">Valor Inteiro</label><br>
                                <input type="text"  name="valor" id="recipient-valor"><br>
                            </div>
                            <div>
                                <label for="valor">Valor Meia</label><br>
                                <input type="text"  name="meia" id="recipient-meia"><br>
                            </div>
                            <button type="submit" class="enviar">Enviar</button>          
                    </form>
            </div>           
            </div> <!-- FIM DO MODAL EDITAR PRECOS -->

            <!-- MODAL CADASTRAR PRECOS -->
            <div class="modal" id="modal-precos">
            <div class="modal-container">
                <img onclick="fechar('#modal-precos')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Cadastrar Preços<h4><br>
                <form action="control/ctr-preco.php#container-precos" method="POST">
                        <input type="hidden" name="cadastrarPrecos">
                        <div>
                            <label for="nome">Nome </label><br>
                            <input type="text" id="nomePreco" class="form-funcionario" name="nomePreco" required><br>
                        </div>
                        <div>
                            <label for="valor">Valor Inteiro</label><br>
                            <input type="text" placeholder="R$" id="valor" class="form-funcionario" name="valor" required><br>
                        </div>
                        <div>
                            <label for="meia">Valor Meia</label><br>
                            <input type="text" placeholder="R$" id="meia" class="form-funcionario" name="meia" required><br>
                        </div><br>
                        <button type="submit" class="enviar">Enviar</button>          
                </form>
           </div>
        </div>
        <!-- FIM GERENCIAMENTO DE PRECOS -->

        <!-- CADASTRO DE SALAS -->
        <div class="cadastro-salas" id="cadastro-salas">
            <form action="control/ctr-sala.php#cadastro-salas" method="POST">
                <input id="recipient-id" type="hidden" name="cadastrarSala">
                <div>
                    <label for="nomeSala">Nome da Sala</label><br>
                    <input type="text" id="nomeSala" class="form-filmes" name="nomeSala"><br>
                </div>
                <div>
                    <label for="qtdAssentos">Qtd. de Assentos</label><br>
                    <input type="number" id="qtdAssentos" class="form-filmes" name="qtdAssentos"><br>
                </div>
                <button type="submit" class="btnAdicionar" >Adicionar</button>
            </form>
            <div>
            <div class="header-gerenciar">
                <h2>Salas</h2>
            </div>
            <table class="tabela">   
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Qtd Assentos</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $sql = "SELECT * FROM sala";
                        $stmt = $objSala->runQuery($sql);
                        $stmt->execute();
                        while($objSala = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <tr>
                            <td><?php echo($objSala['nome'])?></td>
                            <td><?php echo($objSala['qtdAssentos'])?></td>
                            <td><button type="button" class="btnEditar"
                                    data-toggle="modal" data-target="#modal-editar-salas"
                                    data-id="<?php echo($objSala['id'])?>"
                                    data-nome="<?php echo($objSala['nome'])?>"
                                    data-assentos="<?php echo($objSala['qtdAssentos'])?>">
                                    Editar
                            </button>
                            </td>
                            <td><button type="button" class="btnDeletar"
                                    data-toggle="modal" data-target="#modal-deletar-salas"
                                    data-id="<?php print $objSala['id']?>"
                                    data-nome="<?php print $objSala['nome']?>">
                                    Deletar
                            </button>
                            </td>
                        </tr>
                    <!-- FECHAMENTO DO WHILE -->
                         <?php   
                        } 
                         ?> 
                </tbody>
            </table>
            </div>
        </div>  
        <!-- MODAL EDITAR SALAS -->
        <div class="modal" id="modal-editar-salas">
            <div class="modal-container" >
                <img onclick="fechar('#modal-editar-salas')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Editar Sala<h4>
                <form action="control/ctr-sala.php#cadastro-salas" method="POST">
                        <input id="recipient-idSala" type="hidden" name="editarSala">
                        <div>
                            <label for="txtNome">Nome da Sala</label><br>
                            <input type="text" class="form-salas" name="txtNome" id="recipient-nome-sala"  ><br>
                        </div>
                        
                        <div>
                            <label for="txtQtdAssentos">Quantidade de Assentos</label><br>
                            <input type="number"  class="form-salas" name="txtQtdAssentos" id="recipient-qtdAssentos"><br>
                        </div>
                        <button type="submit" class="enviar">Enviar</button>          
                </form>
           </div>           
        </div> <!-- FIM DO MODAL EDITAR SALA -->
        <!-- MODAL DELETAR SALA  -->
        <div class="modal" id="modal-deletar-salas">
            <div class="modal-container">
                <img onclick="fechar('#modal-deletar-salas')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">               
                <h4>Deletar Sala</h4>
                <form action="control/ctr-sala.php#cadastrar-salas" method="POST"> 
                    <input type="hidden" name="deletarSala" id="recipient-idSala">
                    <label for="recipient-nome-sala">Nome</label>
                    <input type="text" name="nomeSala" id="recipient-nome-sala" readonly>
                    <button type="submit" class="enviar">Deletar</button>
                </form>           
            
            </div>
        </div> <!-- FIM DO MODAL DELETAR SALA -->
        <!-- FIM DO GERENCIAMENTO DE SALAS -->

        <!--  INICIO DO GERENCIAR FUNCIONARIOS -->
        <div class="container-funcionarios" id="container-funcionarios">
            <div class="header-gerenciar">
                <h2>Funcionários</h2>
                <button onclick="action('#modal-funcionario')" type="button" class="btnAdicionar">Novo</button>
            </div>
             <table class="tabela">      
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM funcionario";
                        $stmt = $objFuncionario->runQuery($sql);
                        $stmt->execute();
                        while($objFuncionario = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <tr>
                            <td><?php echo($objFuncionario['id'])?></td><!--Aqui ta pegando os dados das colunas da tabela do banco-->
                            <td><?php echo($objFuncionario['nome'])?></td>
                            <td><?php echo($objFuncionario['cpf'])?></td>
                            <td><?php echo($objFuncionario['email'])?></td>
                            <td><button  type="button" class="btnEditar"
                                    data-toggle="modal" data-target="#modal-editar-funcionario"
                                    data-id="<?php echo($objFuncionario['id'])?>"
                                    data-nome="<?php echo($objFuncionario['nome'])?>"
                                    data-cpf="<?php echo($objFuncionario['cpf'])?>"
                                    data-email="<?php echo($objFuncionario['email'])?>"
                                    data-senha="<?php echo($objFuncionario['senha'])?>"                                                      
                                >Editar
                                </button>
                        </td> <!--CHAMA A MODAL DE DELETAR COM O NOME DO FUNCIONARIO-->
                            <td><button type="button"class="btnDeletar" data-toggle="modal" data-target="#modal-deletar-funcionario" 
                            data-id="<?php print $objFuncionario['id']?>"
                            data-nome="<?php print $objFuncionario['nome']?>"
                            >Deletar</button></td>
                        </tr>
                    <!-- FECHAMENTO DO WHILE -->
                         <?php   
                        } 
                         ?> 
                    
                </tbody>
                </table>
        </div>
        <!--CADASTRAR FUNCIONARIO-->
        <div class="modal" id="modal-funcionario">
            <div class="modal-container">
                <img onclick="fechar('#modal-funcionario')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Cadastrar Funcionário<h4>
                <form action="control/ctr-funcionario.php#container-funcionarios" method="POST">
                        <input type="hidden" name="cadastrarFuncionario">
                        <div>
                            <label for="nomeFuncionario">Nome </label><br>
                            <input type="text" id="nomeFuncionario" class="form-funcionario" name="nomeFuncionario" required><br>
                        </div>
                        <div>
                            <label for="cpfFuncionario">CPF</label><br>
                            <input type="text" id="cpfFuncionario" class="form-funcionario" name="cpfFuncionario" required><br>
                        </div>
                        <div>
                            <label for="emailFuncionario">Email</label><br>
                            <input type="email" id="emailFuncionario" class="form-funcionario" name="emailFuncionario" required><br>
                        </div>
                        <div>
                            <label for="senhaFuncionario">Senha</label><br>
                            <input type="password" id="senhaFuncionario" class="form-funcionario" name="senhaFuncionario" required><br>
                        </div>
                        <button type="submit" class="enviar">Confirmar</button>          
                </form>
           </div>
        </div>
        <div class="container-precos" id="container-precos">
                        <h3>TEste</h3>

        </div>
        <!--EDITAR FUNCIONARIO-->
        <div class="modal" id="modal-editar-funcionario">
            <div class="modal-container" >
                <img onclick="fechar('#modal-editar-funcionario')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Editar Funcionário<h4>
                <form action="control/ctr-funcionario.php#container-funcionarios" method="POST">
                        <input id="recipient-id" type="hidden" name="editar">
                        <div>
                            <label for="recipient-nome">Nome </label><br>
                            <input type="text" class="form-funcionario" name="txtNome" id="recipient-nome"  ><br>
                        </div>
                        
                        <div>
                            <label for="recipient-cpf">CPF</label><br>
                            <input type="text"  class="form-funcionario" name="txtCpf" id="recipient-cpf"><br>
                        </div>

                        <div>
                            <label for="recipient-email">Email</label><br>
                            <input type="text"  class="form-funcionario" name="txtEmail" id="recipient-email"><br>
                        </div>
                        <div>
                            <label for="recipient-senha">Senha</label><br>
                            <input type="password"  class="form-funcionario" name="txtSenha" id="recipient-senha"><br>
                        </div>
                        <button type="submit" class="enviar">Confirmar</button>          
                </form>
           </div>           
        </div>
        <div class="modal" id="modal-deletar-funcionario">
            <div class="modal-container modalDeletarFuncionario">
                <img onclick="fechar('#modal-deletar-funcionario')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">              
                <h4>Deletar Funcionário</h4>
                <form action="control/ctr-funcionario.php#container-funcionarios" method="POST"> 
                    <input type="hidden" name="deletarFuncionario" id="recipient-id">
                    <label for="recipient-nome">Nome</label>
                    <input type="text" class="form-funcionario" name="txtNome" id="recipient-nome" readonly>
                    <button type="submit" class="enviar">Confirmar</button>
                </form>
            </div>        
        </div>
        <div class="container-clientes" id="container-clientes">
            <div class="header-gerenciar">
                <h2>Clientes</h2>
                <button onclick="action('#modal-cliente')" type="button" class="btnAdicionar">Novo</button>
            </div>

            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Idade</th>
                        <th>Editar</th>
                        <th>Deletar</th>                        
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $sql = "SELECT * FROM cliente";
                            $stmt = $objCliente->runQuery($sql);//Apontando função acessarBancoDeDados de funcinario e passando a var meuBanco
                            $stmt->execute();//Executa a conexão com o BD
                            while($objCliente = $stmt->fetch(PDO::FETCH_ASSOC)){//Associando a um vetor
                                
                        ?>
                        <tr>
                            <td><?php echo($objCliente['id'])?></td><!--Aqui ta pegando os dados das colunas da tabela do banco-->
                            <td><?php echo($objCliente['nome'])?></td>
                            <td><?php echo($objCliente['cpf'])?></td>
                            <td><?php echo($objCliente['idade'])?></td>                            
                            <td><button type="button" class="btnEditar"
                                    data-toggle="modal" data-target="#modal-editar-cliente"
                                    data-id="<?php echo($objCliente['id'])?>"
                                    data-nome="<?php echo($objCliente['nome'])?>"
                                    data-cpf="<?php echo($objCliente['cpf'])?>"
                                    data-idade="<?php echo($objCliente['idade'])?>"
                                    data-dataNascimento="<?php echo($objCliente['dataNascimento'])?>"
                                >Editar</button>
                            </td>     
                            <td> <!--CHAMA A MODAL DE DELETAR COM O NOME DO CLIENTE-->
                            <button type="button"class="btnDeletar" data-toggle="modal" data-target="#modal-deletar-cliente" 
                            data-id="<?php print $objCliente['id']?>"
                            data-nome="<?php print $objCliente['nome']?>"
                            >Deletar</button>
                        </td>
                        </tr>
                        <?php
                            }
                        ?>
                
                </tbody>
            </table>            
        
        </div>
        <!--CADASTRAR CLIENTE-->
        <div class="modal" id="modal-cliente">
            <div class="modal-container">
                <img onclick="fechar('#modal-cliente')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Cadastrar Cliente</h4>
                <form action="control/ctr-cliente.php#container-clientes" method="POST">
                    <input type="hidden" name="cadastrarCliente">
                    <div>
                        <label for="nomeCliente">Nome</label><br>
                        <input type="text" id="nomeCliente" class="form-cliente" name="nomeCliente"><br>
                    </div>
                    <div>
                        <label for="cpfCliente">CPF</label><br>
                        <input type="text" id="cpfCliente" class="form-cliente" name="cpfCliente"><br>
                    </div>
                    <div>                        
                        <label for="idadeCliente">Idade</label><br>
                        <input type="text" id="idadeeCliente" class="form-cliente" name="idadeCliente"><br>
                    </div>
                    <div>
                        <label for="dataNascimento">Data de Nascimento</label><br>
                        <input type="date" id="dataNascimento" class="form-cliente" name="dataNascimento"><br>
                    </div>
                    <button type="submit" class="enviar">Confirmar</button>          
                </form>
           </div>
        </div>
        <!--EDITAR CLIENTE-->
        <div class="modal" id="modal-editar-cliente">
            <div class="modal-container">
                <img onclick="fechar('#modal-editar-cliente')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">            
                <h4>Editar Cliente<h4>
                <form action="control/ctr-cliente.php#container-clientes" method="POST">
                    <input id="recipient-idCliente" type="hidden" name="editarCliente">
                    <label for="recipient-nomeCliente">Nome</label>
                    <input type="text" name="nomeCliente" id="recipient-nomeCliente">
                    <label for="recipient-cpfCliente">CPF</label>
                    <input type="text" name="cpfCliente" id="recipient-cpfCliente">
                    <label for="recipient-idadeCliente">Idade</label>
                    <input type="text" name="idadeCliente" id="recipient-idadeCliente">
                    <label for="recipient-dataNascimento">Data de Nascimento</label>
                    <input type="date" name="dataNascimento" id="recipient-dataNascimento">
                    <button type="submit" class="enviar">Confirmar</button>                 
                </form>           
            </div>               
        </div>
        <div class="modal" id="modal-deletar-cliente">
            <div class="modal-container modalDeletarCliente">
                <img onclick="fechar('#modal-deletar-cliente')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">               
                <h4>Deletar Cliente</h4>
                <form action="control/ctr-cliente.php#container-clientes" method="POST"> 
                    <input type="hidden" name="deletarCliente" id="recipient-idCliente">
                    <label for="recipient-nomeCliente">Nome</label>
                    <input type="text" name="nomeCliente" id="recipient-nomeCliente" readonly>
                    <button type="submit" class="enviar">Confirmar</button>
                </form>           
            
            </div>
        </div>
    </section>
        <!-- FIM DA SEÇÃO EM QUE FICARÁ TODOS OS GERENCIAR -->
   
    </main> 
    <script src="./js/hover.js"></script>  
    <script src="./js/script.js"></script>

    <!--EDITAR SESSAO-->
    <script>
        $("#modal-editar-sessao").on('show.bs.modal', function(event){
            var buttonSessao = $(event.relatedTarget);
            var recipientIdSessao = buttonSessao.data('id');
            var recipientFilmeSessao = buttonSessao.data('filme');
            var recipientSalaSessao = buttonSessao.data('sala');
            var recipientDataSessao = buttonSessao.data('data');
            var recipientHorarioSessao = buttonSessao.data('horario');

            var modalDeletarSessao = $(this)
            modalDeletarSessao.find("#recipient-id").val(recipientIdSessao);
            modalDeletarSessao.find("#recipient-filme").val(recipientFilmeSessao); 
            modalDeletarSessao.find("#recipient-sala").val(recipientSalaSessao);
            modalDeletarSessao.find("#recipient-data").val(recipientDataSessao);  
            modalDeletarSessao.find("#recipient-horario").val(recipientHorarioSessao);
        })
    </script>

    <!--DELETAR SESSAO-->
    <script>
        $("#modal-deletar-sessao").on('show.bs.modal', function(event){
            var buttonSessao = $(event.relatedTarget);
            var recipientIdSessao = buttonSessao.data('id');
            var recipientFilmeSessao = buttonSessao.data('filme');
            var recipientDataSessao = buttonSessao.data('data');
            var recipientSalaSessao = buttonSessao.data('sala');
            var recipientHorarioSessao = buttonSessao.data('horario');

            var modalDeletarSessao = $(this)
            modalDeletarSessao.find("#recipient-deletar").val(recipientIdSessao);
            modalDeletarSessao.find("#recipient-deletar-filme").val(recipientFilmeSessao); 
            modalDeletarSessao.find("#recipient-deletar-data").val(recipientDataSessao);  
            modalDeletarSessao.find("#recipient-deletar-sala").val(recipientSalaSessao);
            modalDeletarSessao.find("#recipient-deletar-horario").val(recipientHorarioSessao);
        })
    </script>

    <!-- SCRIPT PARA EDITAR PREÇOS -->
    <script>
        $("#modal-editar-precos").on('show.bs.modal', function(event){
            var buttonPrecos = $(event.relatedTarget);
            var recipientIdPrecos = buttonPrecos.data('id');
            var recipientNomePrecos = buttonPrecos.data('nome');
            var recipientValor = buttonPrecos.data('valor');
            var recipientMeia = buttonPrecos.data('meia');
            
            var modalEditarPrecos = $(this)
            modalEditarPrecos.find('#recipient-idPreco ').val(recipientIdPrecos);
            modalEditarPrecos.find('#recipient-nome-preco').val(recipientNomePrecos);
            modalEditarPrecos.find('#recipient-valor').val(recipientValor);
            modalEditarPrecos.find('#recipient-meia').val(recipientMeia);

        })
    </script>

    <!--DELETAR PRECO-->
    <script>
        $("#modal-deletar-precos").on('show.bs.modal', function(event){
            var buttonPreco = $(event.relatedTarget);
            var recipientIdPreco = buttonPreco.data('id');
            var recipientNomePreco = buttonPreco.data('nome');
            var modalDeletarPreco = $(this)
            modalDeletarPreco.find("#recipient-idPreco").val(recipientIdPreco);
            modalDeletarPreco.find("#recipient-nome-preco").val(recipientNomePreco);  
        })
    </script>

    <!-- SCRIPT PARA EDITAR SALA -->
    <script>
        $("#modal-editar-salas").on('show.bs.modal', function(event){
            var buttonSala = $(event.relatedTarget);
            var recipientIdSala = buttonSala.data('id');
            var recipientNomeSala = buttonSala.data('nome');
            var recipientQtdAssentos = buttonSala.data('assentos');
            
            var modalEditarSala = $(this)
            modalEditarSala.find('#recipient-idSala').val(recipientIdSala);
            modalEditarSala.find('#recipient-nome-sala').val(recipientNomeSala);
            modalEditarSala.find('#recipient-qtdAssentos').val(recipientQtdAssentos);
        })
    </script>

    <!--DELETAR SALA-->
    <script>
        $("#modal-deletar-salas").on('show.bs.modal', function(event){
            var buttonSala = $(event.relatedTarget);
            var recipientIdSala = buttonSala.data('id');
            var recipientNomeSala = buttonSala.data('nome');
            var modalDeletarSala = $(this)
            modalDeletarSala.find("#recipient-idSala").val(recipientIdSala);
            modalDeletarSala.find("#recipient-nome-sala").val(recipientNomeSala);  
        })
    </script>

    <!--SCRIPT PARA MANIPULAR O DELETE DE FUNCIONARIO-->
    <script>
        $('#modal-deletar-funcionario').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');/*Pega o valor do id do funcionario*/
            var recipientNome = button.data('nome');
            
            var modal = $(this)
            modal.find('#recipient-id').val(recipientId);
            modal.find('#recipient-nome').val(recipientNome);

        })

    </script>
    <!--SCRIPT PARA MANIPULAR EDIÇÃO DO FUNCIONÁRIO-->
    
    <script>
     $('#modal-editar-funcionario').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);
        var recipientId = button.data('id');//Pegando o valor atribuidos dentro do botão Editar e armazena
        var recipientNomeFunc = button.data('nome');
        var recipientCpfFunc = button.data('cpf');
        var recipientEmailFunc = button.data('email');
        var recipientSenhaFunc = button.data('senha');

        var modal = $(this)
        modal.find('#recipient-id').val(recipientId);//pesquisa onde tem #recipiente-id e atribui o valor q pegou
        modal.find('#recipient-nome').val(recipientNomeFunc);
        modal.find('#recipient-cpf').val(recipientCpfFunc);
        modal.find('#recipient-email').val(recipientEmailFunc);
        modal.find('#recipient-senha').val(recipientSenhaFunc);
})   
     </script> 
    <!--SCRIPT PARA MANIPULAR EDIÇÃO DE CLIENTE-->
    <script>
        $("#modal-editar-cliente").on('show.bs.modal', function(event){
            var buttonCliente = $(event.relatedTarget);
            var recipientIdCliente = buttonCliente.data('id');
            var recipientNomeCliente = buttonCliente.data('nome');
            var recipientCpfCliente = buttonCliente.data('cpf');
            var recipientIdadeCliente = buttonCliente.data('idade');
            var recipientDataNascimento = buttonCliente.data('dataNascimento');
            
            var modalEditarCliente= $(this)
            modalEditarCliente.find('#recipient-idCliente').val(recipientIdCliente);
            modalEditarCliente.find('#recipient-nomeCliente').val(recipientNomeCliente);
            modalEditarCliente.find('#recipient-cpfCliente').val(recipientCpfCliente);
            modalEditarCliente.find('#recipient-idadeCliente').val(recipientIdadeCliente);
            modalEditarCliente.find('#recipient-dataNascimento').val(recipientDataNascimento);
        })
    </script>
    <!--SCRIPT PARA MANIPULAR REMOÇÃO DE CLIENTE-->
    <script>
        $("#modal-deletar-cliente").on('show.bs.modal', function(event){
            var buttonCliente = $(event.relatedTarget);
            var recipientIdCliente = buttonCliente.data('id');
            var recipientNomeCliente = buttonCliente.data('nome');
            var modalDeletarCliente = $(this)
            modalDeletarCliente.find("#recipient-idCliente").val(recipientIdCliente);
            modalDeletarCliente.find("#recipient-nomeCliente").val(recipientNomeCliente);
            
        })
    </script>
    <!--SCRIPT PARA EDITAR FILMES-->
    <script>
        $("#modal-editar-filmes").on('show.bs.modal', function(event){
            var buttonFilme = $(event.relatedTarget);
            var recipientIdFilme = buttonFilme.data('id');
            var recipientNomeCliente = buttonFilme.data('nome');
            var recipientEstreiaFilme = buttonFilme.data('estreia');
            var recipientUltimoDia = buttonFilme.data('ultimoDia');
            var recipientDuracao = buttonFilme.data('duracao');
            var recipientClassIndicativa = buttonFilme.data('classIndicativa');            
            var recipientGenero = buttonFilme.data('genero');
            
            var modalEditarFilme= $(this)
            modalEditarFilme.find('#recipient-idFilme').val(recipientIdFilme);
            modalEditarFilme.find('#recipient-nome-filme').val(recipientNomeCliente);
            modalEditarFilme.find('#recipient-estreia').val(recipientEstreiaFilme);
            modalEditarFilme.find('#recipient-ultimo-dia').val(recipientUltimoDia);
            modalEditarFilme.find('#recipient-duracao').val(recipientDuracao);
            modalEditarFilme.find('#recipient-class-indicativa').val(recipientClassIndicativa);            
            modalEditarFilme.find('#recipient-genero').val(recipientGenero);
        })
    </script>
    <!--SCRIPT PRA REMOÇÃO DE FILME-->
    <script>
        $("#modal-deletar-filmes").on('show.bs.modal', function(event){
            var buttonDeletarFilme = $(event.relatedTarget);
            var recipientIdFilme = buttonDeletarFilme.data('id');
            var recipientNomeFilme = buttonDeletarFilme.data('nome');
            var modalDeletarFilme = $(this);
            modalDeletarFilme.find("#recipient-deletarFilme").val(recipientIdFilme);
            modalDeletarFilme.find("#recipient-deletar-nomeFilme").val(recipientNomeFilme);
            
        })
    </script>
</body>

</html>

<?php
    else: header("Location: ../projetoCinema/index.html"); endif;
?>