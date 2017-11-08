<?php
// Inclui o arquivo 'includes/requisicao.php'
require_once 'includes/requisicao.php';
// Verifica se o método de requisião utilizado é o POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = 'Mensagem de '.$email.":\n".$_POST['mensagem'];

    // Define o endereço de email para onde a mensagem será enviada
    $para = 'email_que_recebera_amensagem@email.com';

    // Envia a mensagem
    mail($para, $assunto, $mensagem);

    redirecionarPara('index.php');
} else {
    redirecionarPara('contato.php');
}   