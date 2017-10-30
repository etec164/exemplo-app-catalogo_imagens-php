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

    $id_imagem = $_POST['id_imagem'];
    
    // Insere dados no banco
    /* Utiliza a função 'obterConexao()' [conexao_de_dados.php] para estabelecer
        * uma conexão com o banco de dados e armazena sua referência na variável 'bd' */
    $bd = obterConexao();
    /* Cria um comando SQL do PDO para ser executado contendo a consulta que
    * criará um novo registro de usuário */
    $comando = $bd->prepare(
        'INSERT INTO comentarios(id_imagem, id_usuario, texto) VALUES(:id_i, :id_u, :t)');
    /* Executa o comando preparado*/
    $result = $comando->execute(
            [':id_u' => $_SESSION['usuario_id'],':id_i' => $id_imagem, ':t' => $_POST['texto']]);
    redirecionarPara('imagem_visualizar.php?id='.$id_imagem);
} else {
    // Redireciona para página com o formulário de inserção
    redirecionarPara('imagem_listar.php');
}