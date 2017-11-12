<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Editar Lançamento - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/categorias.css">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/header.css">
		<link rel="stylesheet" href="Estilos/listar.css">
		<?php
			session_start();
			if($_SESSION['login'] != true){
				echo"<script>alert('É preciso estar logado para entrar!')</script>";
				echo"<script>window.location.replace('index.php')</script>";
			}
			
			include "Funcoes/conectar.php";
			if(isset($_GET['type'])){
				if($_GET['type'] == "R"){
					$tipo = "R";
				}else if($_GET['type'] == "D"){
					$tipo = "D";
				}else{
					echo "<script>window.location.replace('listarLancamentos.php')</script>";
				}
			}
			if(isset($_GET['id'])){
				$id = $_GET['id'];		
				$sql = "SELECT * FROM lancamentos WHERE id = $id";
				$receber = $conectar -> prepare($sql);
				$receber -> execute();
				
				foreach($receber as $editar){
					$tipo = $editar['tipo'];
					$valor = $editar['valor'];
					$descricao = $editar['descricao'];
					$previsao = $editar['previsao'];
				}
			}else{
				echo "<script>window.location.replace('listarLancamentos.php')</script>";
			}
		?>
	</head>
	<body>
		<header class="header" role="banner">
		    <nav class="nav_bar">
		        <ul class="ul_bar">
		            <li class="li_bar"><a href="categorias.php">Categorias</a></li>
		            <li class="li_bar"><a href="outrosLancamentos.php" disabled>Outros Lançamentos</a></li>
		            <li class="li_bar"><a href="totalPendente.php">Total Pendente</a></li>
		            <li class="li_bar"><a href="atrasados.php">Atrasados</a></li>
		            <li class="li_bar"><a href="Funcoes/logout.php">Sair</a></li>
		        </ul>
		    </nav>
		</header>
		<div class="cabecalho">
			<h1 class="Text_cat1">Editar Lançamento</h1>
			<hr>
		</div>
		<div class="conteudo">
			<form method="GET" action="Funcoes/enviarEditar.php">
				<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				Categoria:
				<select name="categoria">
					<?php 
						$sql = "SELECT * FROM categorias WHERE tipo='$tipo' OR tipo='A' ORDER BY nome ASC";
						$receber = $conectar -> prepare($sql);
						$receber -> execute();
						
						foreach($receber as $listar){
							$id_categoria = $listar['id_categoria'];
							$opcao = $listar['nome'];
							echo "<option value='$id_categoria'>$opcao</option>";
						}
					?>
				</select>
				<br><br>
				Valor:
				<input type="text" name="valor" class="input_text" value="<?php echo $valor; ?>">
				<br><br>
				Descrição:
				<br>
				<textarea name="descricao" col="15" class="input_text" rows="6"><?php echo $descricao ?></textarea>
				<br><br>
				Previsão de Pagamento:
				<br>
				<input type="date" name="previsao" value="<?php echo $previsao ?>">
				<br><br>
				<input type="submit" name="atualizar" value="Atualizar">
			</form>
		</div>
	</body>
</html>