<?php
//Inclui o arquivo 'includes/conexao_de_dados.php'
require_once 'includes/conexao_de_dados.php';
// Inclui o arquivo 'includes/autenticacao.php'
require_once 'includes/autenticacao.php';
// Inclui o arquivo 'includes/mensagem.php'
require_once 'includes/mensagem.php';
// Inclui o arquivo 'includes/requisicao.php'
require_once 'includes/requisicao.php';

// Captura o id via método 'GET'
$id = $_GET['id'];

$bd = obterConexao();
/* Cria um comando SQL do PDO para ser executado contendo a consulta que
 * retornará todos as imagens cadastradas do usuário atualmente logado */
$comando = $bd->prepare(
    'SELECT * FROM imagens WHERE id = :i');
 /* Executa o comando preparado */
$result = $comando->execute([':i' => $id]);
// Armazena o resultado da consulta no vetor 'imagem'
$imagem = $comando->fetch(\PDO::FETCH_ASSOC);

/* Define que esta página somente será acessivel por administradores ou o usuário
    * com o id especificado. */
necessitaAutorizacao(false, $imagem['id_usuario']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Usuários</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/imagem_visualizar.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <h1>Imagem</h1>
            <a class="btn btn-default" href="imagem_listar.php">Voltar</a>
            <figure>
                <img src="<?=$imagem[url]?>" />
            </figure>
            <!-- Lista as mensagens para esta página caso existam -->
            <div id="mensagens">
                <ul>
                    <!-- Utiliza a função 'obterMensagem' [mensagem.php] passando como parâmetro
                        o nome do arquivo atual através da função 'basename(__FILE__)', para
                        ler as mensagens caso existam. -->
                    <?php while($msg = obterMensagem(basename(__FILE__))): ?>
                    <li><?= $msg['mensagem'] ?></li>
                    <?php endwhile ?>
                </ul>
            </div>
        </div>
    </body>
</html>