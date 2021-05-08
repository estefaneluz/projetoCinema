<?php
    require_once 'model/acesso-funcionario.php';
    $objFuncionario = new Funcionario(); //Criando obj q recebe as funções de funcionario

?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/acesso-adm.css">
        <link rel="stylesheet" type="text/css" href="./css/responsivo.css">

        <!-- FONTES DO GOOGLE  -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
    
        <!--OWL CSS-->
        <link rel="stylesheet" href="./css/owl/owl.carousel.min.css">
        <link rel="stylesheet" href="./css/owl/owl.theme.default.min.css">
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
                <li><a href="index.html"> Logout</a> </li>
                <li><a href="acesso-adm.php"><img  id="engrenagem-acesso-adm" onmouseover="passaCursor();" onmouseout="retiraCursor();" src="./img/engrenagem.svg" alt="Acesso administrativo"></a></li>
            </ul>
        </nav>
    </header>
   
    
    <div class="acesso-adm" >
        <div class="menu-adm">
            <nav>
                <ul>
                    <li><a href="#cadastro-filmes">Adicionar filmes</a></li>
                    <li><a href="#">Gerenciar Sessões</a></li>
                    <li><a href="#">Administrar Preços</a></li>
                    <li><a href="#cadastro-salas">Gerenciar Salas</a></li>
                    <li><a href="#cadastro-funcionarios">Editar Funcionários</li>
                    <li><a href="#cadastro-clientes">Editar Clientes</a></li>
                </ul>
            </nav>
        </div>
        <div class="cadastro-filmes" id="cadastro-filmes">
            <form action="#">
                <label for="nome">Nome do filme</label><br>
                <input type="text" id="nFilme"class="form-filmes" name="nFilme">
                <div class="colunas">
                    <div class="coluna-1">
                        <label for="estreia">Estreia</label><br>
                        <input type="date" id="estreia"class="form-filmes" name="estreiaFilme"><br>
                        <label for="sala">Sala</label><br>
                        <select class="form-seletor" id="sala" name="sala">
                            <option value="1">A</option>
                            <option value="2">Azul</option>
                            <option value="3">B</option>
                            <option value="4">6D - A</option>
                        </select><br>
                        <label for="horario">Horário</label><br>
                        <select class="form-seletor" id="horario" name="horario">
                            <option value="1">13:10</option>
                            <option value="2">15:00</option>
                            <option value="3">17:30</option>
                            <option value="4">19:40</option>
                            <option value="5">21:50</option>
                        </select><br>
                        <label for="genero">Gênero</label><br>
                        <select class="form-seletor" id="genero" name="genero">
                            <option value="1">Ação</option>
                            <option value="2">Comédia</option>
                            <option value="3">Terror</option>
                            <option value="4">Aventura</option>
                            <option value="5">Crime/Drama</option>
                        </select><br>
                        
                    </div>
                    <div class="coluna-2">
                        <label for="saidaFilme">Último Dia</label><br>
                        <input type="date" id="saidaFilme"class="form-filmes" name="saidaFilme"><br>
                        <label for="precoFilme">Preço</label><br>
                        <input type="text" id="precoFilme"class="form-filmes" placeholder="R$"name="precofilme"><br>
                        <label for="classInd">Class. ind.</label><br>
                        <select class="form-seletor" id="classInd" name="clasInd">
                            <option value="1">Livre</option><br>
                            <option value="2">+10 anos</option>
                            <option value="3">+12 anos</option>
                            <option value="4">+14 anos</option>
                            <option value="5">+16 anos</option>
                            <option value="6">+18 anos</option>
                        </select> <br>   
                        <label for="cartazFilme" class="cartazFilme">Anexar Cartaz</label> <br> 
                        <input type="file" id="cartazFilme" class="cartazFilme" name="cartazFilme"><br>                  
                        
                    </div>
                </div>                
                <button type="submit" class="btnAdicionar" id="btnAdicionar">Adicionar</button>
            </form>
            <div class="filmes-cadastrados">
                <p>Filmes cadastrados</p>
                <div class="lista-filmes">
                    <div id="filme-1"><p>Black Window</p></div>
                    <div id="filme-2"><p>Home Alone</p></div>
                    <div id="filme-3"><p>Halloween 4</p></div>
                    <div id="filme-4"><p>Pulp Fiction</p></div>
                    <div id="filme-5"><p>Monster Hunter</p></div>
                    <div id="filme-6"><p>Raya e o Último Dragão</p></div>
                </div> 
            </div>
        </div>
        <div class="cadastro-salas" id="cadastro-salas">
            <form action="#">
                <label for="nomeSala">Nome da Sala</label><br>
                <input type="text" id="nomeSala" class="form-filmes" name="nomeSala"><br>
                <label for="qtdAssentos">Qtd. de Assentos</label><br>
                <input type="number" id="qtdAssentos" class="form-filmes" name="qtdAssentos"><br>
                <button type="submit" class="btnAdicionar" >Adicionar</button>
            </form>
            <div class="salas-cadastradas">
                <p>Salas Cadastradas</p>
                <div>
                    <div class="nomes-salas">
                        <div><p>Sala A</p></div>
                        <div><p>Sala Azul</p></div>
                        <div><p>Sala B</p></div>
                        <div><p>Sala 6D - A</p></div>
                    </div>
                    <div class="excluir-sala">
                        <button type="button" class="btnExcluir">X</button>
                        <button type="button"class="btnExcluir">X</button>
                        <button type="button" class="btnExcluir">X</button>
                        <button type="button" class="btnExcluir">X</button>
                    </div>
                </div>
            </div>
        </div>  
        <div class="container-funcionarios">
             <table class="tabela-funcionarios ">
                <button onclick="action()" type="button" class="btnAdicionar">Novo</button>
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
                        $meuBanco = "SELECT * FROM funcionario";
                        $estado = $objFuncionario->acessarBancoDedados($meuBanco);//Apontando função acessarBancoDeDados de funcinario e passando a var meuBanco
                        $estado->execute();//Executa a conexão com o BD
                        while($objFuncionario = $estado->fetch(PDO::FETCH_ASSOC)){//Associando a um vetor
                            //Obj funcionario vai receber o estado da conexao em  um array pra percorre cada linha,
                            // o fetch q faz isso, apontando atraves da biblioteca PDO, pegando o resultado e atribuindo ao array
                            //Enquanto tiver linhas na tabela ele será executado
                    ?>
                        <tr>
                            <td><?php echo($objFuncionario['id'])?></td><!--Aqui ta pegando os dados das colunas da tabela do banco-->
                            <td><?php echo($objFuncionario['nome'])?></td>
                            <td><?php echo($objFuncionario['cpf'])?></td>
                            <td><?php echo($objFuncionario['email'])?></td>
                            <td><button onclick="action()" type="button" class="btnEditar">Editar</button></td>
                            <td><button>Deletar</button></td>
                        </tr>
                         <?php   

                        }
                        ?>
                    
                </tbody>

                </table>
        </div>
        
        <div class="modal" id="modal-funcionario">
            <div class="modal-container" id="modalFuncionario">
                <img onclick="fechar()" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Cadastrar Funcionario<h4>
                <form action="control/controle-acesso-adm.php" method="POST">
                        <input type="hidden" name="cadastrarFuncionario">
                        <label for="nomeFuncionario">Nome </label><br>
                        <input type="text" id="nomeFuncionario" class="form-funcionario" name="nomeFuncionario" required><br><br>
                        <label for="cpfFuncionario">CPF</label><br>
                        <input type="text" id="cpfFuncionario" class="form-funcionario" name="cpfFuncionario" required><br><br>
                        <label for="emailFuncionario">Email</label><br>
                        <input type="text" id="emailFuncionario" class="form-funcionario" name="emailFuncionario" required><br><br>
                        <label for="senhaFuncionario">Senha</label><br>
                        <input type="passowrd" id="senhaFuncionario" class="form-funcionario" name="senhaFuncionario" required><br><br>
                        <button type="submit" class="btnEnviar" id="btnEnviar">Enviar</button>          
                </form>
           </div>
        </div>
        <div class="modal" id="modal-editar-funcionario">
            <div class="modal-container" id="modalFuncionario">
                <img onclick="fechar()" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Editar Funcionario<h4>
                <form action="control/controle-acesso-adm.php" method="POST">
                        <input type="hidden" name="cadastrarFuncionario">
                        <label for="nomeFuncionario">Nome </label><br>
                        <input type="text" id="nomeFuncionario" class="form-funcionario" name="nomeFuncionario" ><br><br>
                        <label for="cpfFuncionario">CPF</label><br>
                        <input type="text" id="cpfFuncionario" class="form-funcionario" name="cpfFuncionario" ><br><br>
                        <label for="emailFuncionario">Email</label><br>
                        <input type="text" id="emailFuncionario" class="form-funcionario" name="emailFuncionario" ><br><br>
                        <label for="senhaFuncionario">Senha</label><br>
                        <input type="passowrd" id="senhaFuncionario" class="form-funcionario" name="senhaFuncionario" ><br><br>
                        <button type="submit" class="btnEnviar" id="btnEnviar">Enviar</button>          
                </form>
           </div>           
        </div>
        <div class="cadastro-clientes" id="cadastro-clientes">
            <form action="#">
                <label for="nomeCliente">Nome</label><br>
                <input type="text" id="nomeCliente" class="form-cliente" name="nomeCliente"><br>
                <div class="nascimento-sexo" >
                    <div>
                        <label for="dataNascimento">Data de Nascimento</label><br>
                        <input type="date" id="dataNascimento" class="form-cliente" name="dataNascimento"><br>
                    </div>
                    <div>
                        <label for="sexo">Sexo</label><br>
                        <select class="form-seletor-cliente" id="sexo" name="sexo">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="ND">Não declarado</option>
                        </select>
                    </div>
                </div> 
                <div class="cpf-idade">
                    <div>
                        <label for="cpfCliente">CPF</label><br>
                        <input type="text" id="cpfCliente" class="form-cliente" name="cpfCliente"><br>
                    </div>
                    <div>
                        <label for="idadeCliente">Idade</label><br>
                        <input type="text" id="idadeCliente" class="form-cliente" name="idadeCliente"><br>
                    </div>                    
                 </div>
                <div class="email-senha">
                    <div>
                        <label for="emailCliente">Email</label><br>
                        <input type="email" id="emailCliente" class="form-cliente" name="emailCliente"><br>
                    </div>
                    <div>
                        <label for="senhaCliente">Senha</label><br>
                        <input type="text" id="senhaCliente" class="form-cliente" name="senhaCliente"><br>
                     </div>   
                </div>   
                <button type="submit" class="btnAdicionar" id="btnAdicionar">Adicionar</button>          
           </form>
           
        </div>
    </div> 
    <script src="./js/hover.js"></script>  
    <script src="./js/script.js"></script>
</body>

</html>