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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Categorias - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/categorias.css">
		<link rel="stylesheet" href="Estilos/header.css">
		<link rel="stylesheet" href="Estilos/listar.css">
		<script src="Funcoes/confirmar.js"></script>
	</head>
	<body>
		<header class="header" role="banner">
		    <nav class="nav_bar">
		        <ul class="ul_bar">
		            <li class="li_bar"><a href="categorias.php">Categorias</a></li>
		            <li class="li_bar"><a href="outrosLancamentos.php">Outros Lançamentos</a></li>
		            <li class="li_bar"><a href="totalPendente.php">Total Pendente</a></li>
		            <li class="li_bar"><a href="atrasados.php">Atrasados</a></li>
		            <li class="li_bar"><a href="Funcoes/logout.php">Sair</a></li>
		        </ul>
		    </nav>
		</header>
		<div class="cabecalho">
			<h1 class="Text_cat1">Categorias</h1>
		</div>
		<div class="conteudo">
			<div class="voltar">
				<a href="listarLancamentos.php"><input type="button" value="Voltar"></a>
			</div>
			<div class="adicionar" style="padding-bottom: 50px;">
				<h2 class="Text_cat">Nova Categoria</h2>
				<form method="GET" action="Funcoes/enviarCategoria.php">
					Nome da Categoria:
					<input type="text" name="nome" class="input_text">
					<br><br>
					Tipo da Categoria:
					<select name="tipo" class="input_text">
						<option selected disabled></option>
						<option value="D">Despesa</option>
						<option value="R">Receita</option>
						<option value="A">Ambos</option>
					</select>
					<br><br>
					<input type="submit" name="enviarCategoria" value="Cadastrar">
				</form>
			</div>
			<div class="tabela">
				<table class="tabela-top">
					<tr>
						<th>Nome da Categoria</th>
						<th>Tipo de Lançamento</th>
						<th colspan="2">Operações</th>
					</tr>
					<?php
						$sql = "SELECT * FROM categorias ORDER BY tipo ASC";
						$receber = $conectar -> prepare($sql);
						$receber -> execute();
						foreach($receber as $listar){
							$id = $listar['id_categoria'];
							$nome = $listar['nome'];
							$tipo = $listar['tipo'];
							
							if($tipo == "R"){
								$tipo = "Receita";
								$classeTipo = "receita";
							}else if($tipo == "D"){
								$tipo = "Despesa";
								$classeTipo = "despesa";
							}else if($tipo == "A"){
								$tipo = "Ambos";
								$classeTipo = "ambos";
							}
							
							echo"
								<tr>
									<td>$nome</td>
									<td class='$classeTipo'>$tipo</td>
									<td><input type='image' src='Imagens/editar.png' name='editar' title='Editar' onClick='editarCategoria($id)'></td>
									<td><input type='image' src='Imagens/excluir.png' name='excluir' title='Excluir' onClick='excluirCategoria($id)'></td>
								</tr>
							";
						}
					?>
				</table>
			</div>
		</div>
	</body>
</html>