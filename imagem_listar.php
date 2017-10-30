<?php
// Inclui o arquivo 'includes/conexao_de_dados.php'
require_once 'includes/conexao_de_dados.php';
// Inclui o arquivo 'includes/autenticacao.php'
require_once 'includes/autenticacao.php';
// Inclui o arquivo 'includes/mensagem.php'
require_once 'includes/mensagem.php';

// Define que esta página somente será acessivel por administradores
necessitaAutorizacao();

/* Utiliza a função 'obterConexao()' [conexao_de_dados.php] para estabelecer
* uma conexão com o banco de dados e armazena sua referência na variável 'bd' */
$bd = obterConexao();
/* Cria um comando SQL do PDO para ser executado contendo a consulta que
 * retornará todos as imagens cadastradas do usuário atualmente logado */
$comando = $bd->prepare(
    'SELECT * FROM imagens WHERE id_usuario = :id_u');
 /* Executa o comando preparado */
$result = $comando->execute([':id_u' => $_SESSION['usuario_id']]);
// Armazena o resultado da consulta no vetor 'imagens'
$imagens = $comando->fetchAll(\PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Usuários</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div>
            <?php if(estaAutorizado()): ?>
                    <a class="btn btn-danger" href="logout.php">Logout (<?= $_SESSION['usuario_email'] ?>)</a>
                    <?php else: ?>
                    <a class="btn btn-default" href="login.php">Login</a>
                    <?php endif; ?>
            </div>
            <h1>Imagens</h1>
            <a class="btn btn-default" href="imagem_insert.php">Adicionar Imagem</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>URL</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($imagens as $i): ?>
                    <tr>
                        <td><?= $i['id'] ?></td>
                        <td>
                            <a href="imagem_visualizar.php?id=<?=$i['id']?>">
                                <?= $i['url'] ?>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="imagem_delete.php?id=<?= $i['id'] ?>">Remover</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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