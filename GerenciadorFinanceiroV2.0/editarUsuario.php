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
			if(isset($_GET['id'])){
				$id = $_GET['id'];		
				$sql = "SELECT * FROM cadastros WHERE id_usuario = $id";
				$receber = $conectar -> prepare($sql);
				$receber -> execute();
				
				foreach($receber as $editar){
					$nome = $editar['nome_usuario'];
					$senha = $editar['senha'];
					$privilegio = $editar['privilegio'];
				}
			}else{
				echo "<script>window.location.replace('listarLancamentos.php')</script>";
			}
			
			if($privilegio == "N"){
				$privilegio = "Normal";
			}else if($privilegio == "A"){
				$privilegio = "Administrador";
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
			<form method="GET" action="Funcoes/enviarUsuario.php">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				Nome:
				<input type="text" name="nome" class="input_text" value="<?php echo $nome; ?>">
				<br><br>
				Senha:
				<input type="text" name="senha" class="input_text" value="<?php echo $senha; ?>">
				<br><br>
				Privilégio:
				<select name="privilegio">
					<option select><?php echo $privilegio; ?></option>
					<option value="N">Normal</option>
					<option value="A">Administrador</option>
				</select>
				<br><br>
				<input type="submit" name="atualizar" value="Atualizar">
			</form>
		</div>
	</body>
</html>