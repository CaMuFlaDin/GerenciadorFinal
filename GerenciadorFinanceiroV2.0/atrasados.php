<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lançamentos Atrasados - GerFin</title>
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
	
			include "Funcoes/conectar.php";
			$dataHoje = date('Ymd');
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
			<h1 class="Text_cat1">Lançamentos Atrasados</h1>
		</div><br><br>
		<div class="conteudo">
			<div class="voltar">
				<a href="listarLancamentos.php"><input type="button" value="Voltar"></a>
			</div>
			<div class="tabela">
				<table class="tabela-top">
					<tr>
						<th>Tipo</th>
						<th>Previsão</th>
						<th>Efetivada</th>
						<th>Categoria</th>
						<th>Descrição</th>
						<th>Valor</th>
						<th>Status</th>
						<th>Enviado por</th>
						<th>Data de Envio</th>
						<th colspan="3">Operações</th>
					</tr>
					<?php
						$id = $_SESSION['id'];
						$sqlTabela = "WHERE cadastros.id_usuario=$id AND categorias.id_categoria=lancamentos.id_categoria AND lancamentos.id_usuario=cadastros.id_usuario AND efetivada='0000-00-00' ORDER BY lancamentos.tipo ASC, lancamentos.previsao ASC";
						$sql = "SELECT * FROM categorias,lancamentos,cadastros $sqlTabela";
						$receber = $conectar -> prepare($sql);
						$receber -> execute();
						
						foreach($receber as $listar){
							$id = $listar['id'];
							$tipo = $listar['tipo'];
							$previsao = $listar['previsao'];
							$efetivada = $listar['efetivada'];
							$id_categoria = utf8_encode($listar['nome']);
							$descricao = utf8_encode($listar['descricao']);
							$valor = $listar['valor'];
							$nome_usuario = $listar['nome_usuario'];
							$data_envio = $listar['data_envio'];
							
							$tempo = str_replace("-","",$previsao);
							if($tempo < $dataHoje){
							
								$classe = "atrasado";
								$status = "Atrasado";
								$efetivada = "Não Efetivada";
								
								$previsao = date('d/m/Y', strtotime($previsao));
								$data_envio = date('d/m/Y', strtotime($data_envio));
								
								if($tipo == "D"){
									$imagemTipo = "menos.png";
								}else if($tipo = "R"){
									$imagemTipo = "mais.png";
								}else{
									$imagemTipo = "nenhum.png";
								}
								
								$pagamento = "pagar";
								$ativar = "";
								
								$titlePagamento = ucfirst($pagamento);
								
								echo"	
									<tr class='$classe'>
										<td class='tdImagem semCor'><img src='Imagens/$imagemTipo'></td>
										<td>$previsao</td>
										<td>$efetivada</td>
										<td>$id_categoria</td>
										<td>$descricao</td>
										<td>R$ $valor</td>
										<td>$status</td>
										<td>$nome_usuario</td>
										<td>$data_envio</td>
										<td class='semCor'><input type='image' src='Imagens/editar.png' name='editar' title='Editar' onClick='editar($id, 2)'></td>
										<td class='semCor'><input type='image' src='Imagens/$pagamento.png' name='pagar' $ativar title='$titlePagamento' onClick='pagar($id, 2)'></td>
										<td class='semCor'><input type='image' src='Imagens/excluir.png' name='excluir' title='Excluir' onClick='excluir($id, 2)'></td>
									</tr>
								";
							}
						}
					?>
				</table>
			</div>
		</div>
	</body>
</html>