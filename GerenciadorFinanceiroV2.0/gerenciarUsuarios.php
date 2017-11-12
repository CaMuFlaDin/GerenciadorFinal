<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Usuários - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/header.css">
		<link rel="stylesheet" href="Estilos/listar.css">
		<script src="Funcoes/confirmar.js"></script>
		<script src="Funcoes/header.js"></script>
		<script>
			function excluirUsuario(id){
				if(confirm("Deseja mesmo excluir este usuário?")){
					window.location.replace("Funcoes/excluirUsuario.php?conf=1&id="+id);
				}
			}
			function editarUsuario(id){
				window.location.href = "editarUsuario.php?conf=1&id="+id;
			}
		</script>
		<?php
			session_start();
			$id = $_SESSION['id'];
			if($_SESSION['login'] != true){
				echo"<script>alert('É preciso estar logado para entrar!')</script>";
				echo"<script>window.location.replace('index.php')</script>";
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
		<div class="voltar">
					<a href="listarLancamentos.php"><input type="button" value="Voltar"></a>
				</div>
		<div class="conteudo">
			<hr class="divideBig">
			<br>
			<div class="tabela" style="padding-top: 100px;">
				<table class="tabela-top">
					<tr>
						<th>Nome</th>
						<th>Senha</th>
						<th>Privilégio</th>
						<th>Data de Inicio</th>
						<th colspan="2">Operações</th>
					</tr>
					<?php		
						include "Funcoes/conectar.php";
						$sql = "SELECT * FROM cadastros";
						$receber = $conectar -> prepare($sql);
						$receber -> execute();
						
						foreach($receber as $listarusuario){
							$id = $listarusuario['id_usuario'];
							$nome_usuario = $listarusuario['nome_usuario'];
							$senha = $listarusuario['senha'];
							$privilegio = $listarusuario['privilegio'];
							$data_inicio = $listarusuario['data_inicio'];
							$dataNova  = date('d/m/Y',strtotime($listarusuario["data_inicio"]));
							if($privilegio == 'A'){
								$privilegio = 'Administrador';
							}else if($privilegio == 'N'){
								$privilegio = 'Normal';
							}
							echo"	
								<tr>
									<td>$nome_usuario</td>
									<td>$senha</td>
									<td>$privilegio</td>
									<td>$dataNova</td>
									<td><input type='image' src='Imagens/editar.png' name='editar' title='Editar' onClick='editarUsuario($id, 1)'></td>
									<td><input type='image' src='Imagens/excluir.png' name='excluir' title='Excluir' onClick='excluirUsuario($id, 1)'></td>
								</tr>
							";
						}
					?>
				</table>
			</div>
		</div>
	</body>
</html>