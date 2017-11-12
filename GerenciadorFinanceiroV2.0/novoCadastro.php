<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Categorias - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/categorias.css">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/header.css">
		<link rel="stylesheet" href="Estilos/listar.css">
		<script src="Funcoes/confirmar.js"></script>
		<?php
			if(isset($GET["salvar"])){
				$id = "";
				$nome = $GET["nome"];
				$senha = $_POST["senha"];
				
				include "conexao.php";
				$sql = "INSERT INTO contatos_tb VALUE (?,?,?,?,?,?,?,?)";
				$contatos = $fusca -> prepare($sql);
				$contatos -> execute(array($id, $nome, $telefone, $email, $endereco, $sexo, $nascimento, $obs));
				$contatos = null;
			}
		?>
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
			<h1 class="Text_cat1">Cadastrar</h1>
		</div>
		<div class="conteudo">
			<div class="voltar">
				<a href="listarLancamentos.php"><input type="button" value="Voltar"></a>
			</div>
			<div class="adicionar">
				<form method="POST" action="Funcoes/cadastrarUsuario.php">
					Nome:
					<input type="text" name="nome" class="input_text">
					<br><br>
					Senha:
					<input type="password" name="senha" class="input_text">
					<br><br>
					Privilégio:
					<select name="privilegio">
						<option> </option>
						<option value="N">Normal</option>
						<option value="A">Administrador</option>
					</select>
					<br><br>
					<input type="submit" name="enviar" value="Cadastrar">
				</form>
			</div>
		</div>
	</body>
</html>