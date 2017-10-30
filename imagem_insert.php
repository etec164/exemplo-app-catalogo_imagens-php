<?php
// Inclui o script 'includes/autenticacao.php'
require_once 'includes/autenticacao.php';
// Inclui o script 'includes/mensagem.php'
require_once 'includes/mensagem.php';

$titulo = "Adicionar Imagem";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$titulo?></title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <h1><?=$titulo?></h1>
            <form action="imagem_insert_confirm.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Arquivo</label>
                    <input type="file" name="fileUpload" />
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="imagem_listar.php" class="btn btn-default">Voltar</a>
            </form>
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