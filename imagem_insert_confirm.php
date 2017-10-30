<?php
// Verifica se o método de requisião utilizado é o POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Inclui o arquivo 'includes/conexao_de_dados.php'
    require_once 'includes/conexao_de_dados.php';
    // Inclui o arquivo 'includes/autenticacao.php'
    require_once 'includes/autenticacao.php';
    // Inclui o arquivo 'includes/mensagem.php'
    require_once 'includes/mensagem.php';
    // Inclui o arquivo 'includes/requisicao.php'
    require_once 'includes/requisicao.php';

    necessitaAutorizacao();

    // Define o diretório onde a imagem será salva
    $img_path = 'assets/img/catalogo/';
    // Captura a extenssão do arquivo
    $file_uploaded_type = substr($_FILES['fileUpload']['name'], strrpos($_FILES['fileUpload']['name'], '.'));
    // Cria um nome único para a imagem
    $file_name = $_SESSION['usuario_id'].date("Y.m.d-H.i.s").$file_uploaded_type;
    // Salva a imagem no servidor
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $img_path.$file_name);
    // Insere dados no banco
    /* Utiliza a função 'obterConexao()' [conexao_de_dados.php] para estabelecer
        * uma conexão com o banco de dados e armazena sua referência na variável 'bd' */
    $bd = obterConexao();
    /* Cria um comando SQL do PDO para ser executado contendo a consulta que
    * criará um novo registro de usuário */
    $comando = $bd->prepare(
        'INSERT INTO imagens(url, id_usuario) VALUES(:u, :id_u)');
    /* Executa o comando preparado*/
    $result = $comando->execute(
            [':u' => $img_path.$file_name,':id_u' => $_SESSION['usuario_id']]);
    // Verifica se o comando foi executado sem erros e cria a respectiva mensagem
    $mensagem = ($result) ? 'Imagem Adicionada com Sucesso' : 'Erro ao Adicionar Imagem';
    registrarMensagem('imagem_listar.php', $mensagem);
    redirecionarPara('imagem_listar.php');
} else {
    // Redireciona para página com o formulário de inserção
    redirecionarPara('imagem_insert.php');
}