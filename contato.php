<?php
// Inclui o script 'includes/mensagem.php'
require_once 'includes/mensagem.php';

$titulo = "Contato";
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
            <form action="contato_confirm.php" method="post">
                <h3><?=$titulo?></h3>
                <div class="form-group">
                    <label>Digite seu E-Mail</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Assunto</label>
                    <input type="text" name="assunto" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea class="form-control" rows="10" name="mensagem"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
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