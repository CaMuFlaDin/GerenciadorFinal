<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Adicionar Lançamento - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/categorias.css">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/header.css">
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
			<h1 class="Text_cat1">Adicionar Lançamento</h1>
		</div>
		<div class="voltar">
			<a href="listarLancamentos.php"><input type="button" value="Voltar"></a>
		</div>
		<div class="conteudo">
			<form method="GET" action="Funcoes/enviarLancamento.php">
				<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
				Categoria:
				<select class="input_text" name="categoria">
					<?php 
						$sql = "SELECT * FROM categorias WHERE tipo='$tipo' OR tipo='A' ORDER BY nome ASC";
						$receber = $conectar -> prepare($sql);
						$receber -> execute();
						
						foreach($receber as $listar){
							$id_categoria = $listar['id_categoria'];
							$opcao = utf8_encode($listar['nome']);
							echo "<option value='$id_categoria'>$opcao</option>";
						}
					?>
				</select>
				<br><br>
				Valor:
				<input class="input_text" type="number" step="0.01" name="valor" min="1">
				<br><br>
				Descrição:
				<br>
				<textarea class="input_text" name="descricao" col="15" rows="6"></textarea>
				<br><br>
				Previsão de Pagamento:
				<br>
				<input type="date" name="previsao">
				<br><br>
				<input class="add" type="submit" name="adicionar" value="Adicionar">
			</form>
		</div>
	</body>
</html>