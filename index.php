<?php
// Inclui o script 'includes/autenticacao.php'
require_once 'includes/autenticacao.php';
// Inclui o script 'includes/mensagem.php'
require_once 'includes/mensagem.php';

$titulo = 'Catalogo de Imagens';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$titulo?></title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/index.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <h1><?=$titulo?></h1>
            <ul>
                <li>
                    <?php if(estaAutorizado()): ?>
                    <a class="btn btn-danger" href="logout.php">Logout (<?= $_SESSION['usuario_email'] ?>)</a>
                    <?php else: ?>
                    <a class="btn btn-default" href="login.php">Login</a>
                    <?php endif; ?>
                </li>
                <li><a class="btn btn-default" href="usuario_insert.php">Registrar Usuário</a></li>
                <?php if(estaAutorizado(true)): ?>
                <li><a class="btn btn-default" href="usuarios.php">Lista de Usuários</a></li>
                <?php endif; ?>
            </ul>
            <div id="mensagens">
                <ul>
                    <?php while($msg = obterMensagem(basename(__FILE__))): ?>
                    <li><?= $msg['mensagem'] ?></li>
                    <?php endwhile ?>
                </ul>
            </div>
        </div>
    </body>
</html>