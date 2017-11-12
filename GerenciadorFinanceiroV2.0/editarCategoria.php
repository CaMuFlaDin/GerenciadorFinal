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
			session_start();
			if($_SESSION['login'] != true){
				echo"<script>alert('É preciso estar logado para entrar!')</script>";
				echo"<script>window.location.replace('index.php')</script>";
			}
			
			if(isset($_GET['id'])){
				include "Funcoes/conectar.php";
				$id = $_GET['id'];
				$sql = "SELECT * FROM categorias WHERE id_categoria=$id";
				$receber = $conectar -> prepare($sql);
				$receber -> execute();
				
				foreach($receber as $listar){
					$id = $listar['id_categoria'];
					$nome = $listar['nome'];
					$tipo = $listar['tipo'];
				}
			}else{
				echo "<script>window.location.replace('categorias.php')</script>";
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
			<h1 class="Text_cat1">Editar Categoria</h1>
		</div>
		<div class="conteudo">
			<div class="voltar">
				<a href="categorias.php"><input type="button" value="Voltar"></a>
			</div>
			<div class="adicionar">
				<form method="GET" action="Funcoes/enviarEditarCategoria.php">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					Nome da Categoria:
					<input type="text" name="nome" value="<?php echo $nome; ?>" class="input_text">
					<br><br>
					Tipo da Categoria:
					<select name="tipo" class="input_text">
						<option value="D" <?php if($tipo == "D"){echo "selected";} ?>>Despesa</option>
						<option value="R" <?php if($tipo == "R"){echo "selected";} ?>>Receita</option>
						<option value="A" <?php if($tipo == "A"){echo "selected";} ?>>Ambos</option>
					</select>
					<br><br>
					<input type="submit" name="atualizar" value="Atualizar">
				</form>
			</div>
		</div>
	</body>
</html>