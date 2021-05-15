<?php
    require_once 'model/acesso-funcionario.php';
    $objFuncionario = new Funcionario(); //Criando obj q recebe as funções de funcionario

?>
<?php
    require_once 'model/model-cliente.php';
    $objCliente = new Cliente();

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
                <li><a href="index.html"> Logout</a> </li>
                <li><a href="acesso-adm.php"><img  id="engrenagem-acesso-adm" onmouseover="passaCursor();" onmouseout="retiraCursor();" src="./img/engrenagem.svg" alt="Acesso administrativo"></a></li>
            </ul>
        </nav>
    </header>

    <main class="acesso-adm">
        <aside class="menu-adm">
            <nav>
                <h3>Gerenciar</h3>
                <ul>
                    <li><a href="#cadastro-filmes">filmes</a></li>
                    <li><a href="#">Sessões</a></li>
                    <li><a href="#">Preços</a></li>
                    <li><a href="#cadastro-salas">Salas</a></li>
                    <li><a href="#container-funcionarios">Funcionários</li>
                    <li><a href="#container-clientes">Clientes</a></li>
                </ul>
            </nav>
        </aside>
        
        <!-- SEÇÃO EM QUE FICARÁ TODOS OS GERENCIAR -->
        <section class="container-gerenciar">
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
                        <label for="duracao">Duração</label><br>
                        <select class="form-seletor" id="duracao" name="duracao">
                            <option value="1:00">1h:00min</option>
                            <option value="1:30">1h:30min</option>
                            <option value="2:00">2h:00min</option>
                            <option value="2:30">2h:30min</option>
                            <option value="3:00">3h:00min</option>
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
        
        <!-- CADASTRO DE SALAS -->
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
                <form action="control/controle-acesso-adm.php#container-funcionarios" method="POST">
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
                            <input type="text" id="emailFuncionario" class="form-funcionario" name="emailFuncionario" required><br>
                        </div>
                        <div>
                            <label for="senhaFuncionario">Senha</label><br>
                            <input type="password" id="senhaFuncionario" class="form-funcionario" name="senhaFuncionario" required><br>
                        </div>
                        <button type="submit" class="enviar" id="btnEnviar">Enviar</button>          
                </form>
           </div>
        </div>
        <!--EDITAR FUNCIONARIO-->
        <div class="modal" id="modal-editar-funcionario">
            <div class="modal-container modalFuncionario" >
                <img onclick="fechar('#modal-editar-funcionario')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">
                <h4>Editar Funcionário<h4>
                <form action="control/controle-acesso-adm.php#container-funcionarios" method="POST">
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
                        <button type="submit" class="enviar" id="btnEnviar">Enviar</button>          
                </form>
           </div>           
        </div>
        <div class="modal" id="modal-deletar-funcionario">
            <div class="modal-container modalDeletarFuncionario">
                <img onclick="fechar('#modal-deletar-funcionario')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">              
                <h4>Deletar Funcionário</h4>
                <form action="control/controle-acesso-adm.php#container-funcionarios" method="POST"> 
                    <input type="hidden" name="deletarFuncionario" id="recipient-id">
                    <label for="recipient-nome">Nome</label>
                    <input type="text" class="form-funcionario" name="txtNome" id="recipient-nome" readonly>
                    <button type="submit" class="enviar" id="btnEnviar">Deletar</button>
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
                            $meuBanco = "SELECT * FROM cliente";
                            $estado = $objCliente->acessarBancoDedados($meuBanco);//Apontando função acessarBancoDeDados de funcinario e passando a var meuBanco
                            $estado->execute();//Executa a conexão com o BD
                            while($objCliente = $estado->fetch(PDO::FETCH_ASSOC)){//Associando a um vetor
                                
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
                <form action="control/controle-cliente.php#container-clientes" method="POST">
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
                    <button type="submit" class="enviar" id="btnEnviar">Enviar</button>          
                </form>
           </div>
        </div>
        <!--EDITAR CLIENTE-->
        <div class="modal" id="modal-editar-cliente">
            <div class="modal-container modalCliente">
                <img onclick="fechar('#modal-editar-cliente')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">            
                <h4>Editar Cliente<h4>
                <form action="control/controle-cliente.php#container-clientes" method="POST">
                    <input id="recipient-idCliente" type="hidden" name="editarCliente">
                    <label for="recipient-nomeCliente">Nome</label>
                    <input type="text" name="nomeCliente" id="recipient-nomeCliente">
                    <label for="recipient-cpfCliente">CPF</label>
                    <input type="text" name="cpfCliente" id="recipient-cpfCliente">
                    <label for="recipient-idadeCliente">Idade</label>
                    <input type="text" name="idadeCliente" id="recipient-idadeCliente">
                    <label for="recipient-dataNascimento">Data de Nascimento</label>
                    <input type="date" name="dataNascimento" id="recipient-dataNascimento">
                    <button type="submit" class="enviar" id="btnEnviar">Enviar</button>                 
                </form>           
            </div>               
        </div>
        <div class="modal" id="modal-deletar-cliente">
            <div class="modal-container modalDeletarCliente">
                <img onclick="fechar('#modal-deletar-cliente')" class="fechar" src="./img/fechar.svg" alt="Icone para fechar o poup-up.">               
                <h4>Deletar Cliente</h4>
                <form action="control/controle-cliente.php#container-clientes" method="POST"> 
                    <input type="hidden" name="deletarCliente" id="recipient-idCliente">
                    <label for="recipient-nomeCliente">Nome</label>
                    <input type="text" name="nomeCliente" id="recipient-nomeCliente" readonly>
                    <button type="submit" class="enviar" id="btnEnviar">Deletar</button>
                </form>           
            
            </div>
        </div>
    </div> 

    </section>
        <!-- FIM DA SEÇÃO EM QUE FICARÁ TODOS OS GERENCIAR -->
    </main> 
    <!-- FIM DO MAIN -->


    <script src="./js/hover.js"></script>  
    <script src="./js/script.js"></script>
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

</body>

</html>