<?php
	session_start();
	if($_SESSION['login'] != true){
		echo"<script>alert('É preciso estar logado para entrar!')</script>";
		echo"<script>window.location.replace('index.php')</script>";
	}
	include "Funcoes/conectar.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Administrador - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/listar.css">
		<script src="Funcoes/confirmar.js"></script>
	</head>
	<body>
		<div class="cabecalho">
			<h1>Administrador</h1>
			<hr class="divideSmall">
		</div>
		<div class="voltar">
			<a href="listarLancamentos.php"><input type="button" value="Voltar"></a>
		</div>
		<div class="conteudo">
			<a href="novoCadastro.php"><input type="button" value="Cadastrar Novo Usuário"></a>
			<a href="gerenciarUsuarios.php"><input type="button" value="Gerenciador de Usuários"></a>
		</div>
	</body>
</html>