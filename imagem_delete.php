<?php

// Inclui o arquivo 'includes/conexao_de_dados.php'
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

$comando = $bd->prepare(
    'DELETE FROM comentarios WHERE id_imagem = :i');
/* Executa o comando preparado */
$result = $comando->execute([':i' => $id]);

/* Cria um comando SQL do PDO para ser executado contendo a consulta que
    * criará um novo registro de usuário */
$comando = $bd->prepare(
    'DELETE FROM imagens WHERE id = :i');
/* Executa o comando preparado */
$result = $comando->execute([':i' => $id]);
// Verifica se o comando foi executado sem erros e cria a respectiva mensagem
$mensagem = ($result) ? 'Imagem Removida' : 'Erro ao Remover Imagem';
// Remove a imagem do servidor
unlink($imagem['url']);

registrarMensagem('imagem_listar.php', $mensagem);
// Redireciona para página com a lista de imagens
redirecionarPara('imagem_listar.php');