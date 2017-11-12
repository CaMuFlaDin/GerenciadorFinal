<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Lançamentos - GerFin</title>
		<link rel="shortcut icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/todos.css">
		<link rel="stylesheet" href="Estilos/header.css">
		<link rel="stylesheet" href="Estilos/listar.css">
		<script src="Funcoes/confirmar.js"></script>
		<script src="Funcoes/header.js"></script>
		<?php
			session_start();
			$id = $_SESSION['id'];
			if($_SESSION['login'] != true){
				echo"<script>alert('É preciso estar logado para entrar!')</script>";
				echo"<script>window.location.replace('index.php')</script>";
			}
			if($_SESSION['privilegio'] == "A"){
				echo "
					<div class='adm'>
						<a href='adm.php'><input type='button' value='Administrador'></a>
					</div>
				";
				$sqlWhere1 = "WHERE tipo = 'R' AND efetivada != '0000-00-00'";
				$sqlWhere2 = "WHERE tipo = 'D' AND efetivada = '0000-00-00'";
				$sqlTabela = "WHERE categorias.id_categoria=lancamentos.id_categoria AND lancamentos.id_usuario=cadastros.id_usuario ORDER BY lancamentos.efetivada ASC, lancamentos.tipo ASC, lancamentos.previsao ASC";
			}else{
				$sqlWhere1 = "WHERE tipo = 'R' AND id_usuario=$id AND efetivada!='0000-00-00'";
				$sqlWhere2 = "WHERE tipo = 'D' AND id_usuario=$id AND efetivada = '0000-00-00'";
				$sqlTabela = "WHERE cadastros.id_usuario=$id AND categorias.id_categoria=lancamentos.id_categoria AND lancamentos.id_usuario=cadastros.id_usuario ORDER BY lancamentos.efetivada ASC, lancamentos.tipo ASC, lancamentos.previsao ASC";
			}
			include "Funcoes/conectar.php";
			$sql = "SELECT SUM(valor) AS receitas FROM lancamentos $sqlWhere1";
			$receber = $conectar -> prepare($sql);
			$receber -> execute();
			foreach($receber as $guardar){
				$receitas = $guardar['receitas'];
			}
			
			$sql = "SELECT SUM(valor) AS despesas FROM lancamentos $sqlWhere2";
			$receber = $conectar -> prepare($sql);
			$receber -> execute();
			foreach($receber as $guardar){
				$despesas = $guardar['despesas'];
			}
			if(isset($receitas) && isset($despesas)){
				$saldoAtual = $receitas - $despesas;
				$saldoAtual = number_format($saldoAtual, 2, ",", "");
			}else{
				$saldoAtual = 0.00;
			}
			header("Content-type: text/html; charset=utf-8");
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
		<div class="conteudo">
			<div class="menuAbove">
				<div class="dividir">
					<a href="adicionarLancamento.php?type=R"><input type="image" name="receita" src="Imagens/mais.png" title="Adidionar Receita" alt="Adicionar Receita"></a>
					<a href="adicionarLancamento.php?type=D"><input type="image" name="despesa" src="Imagens/menos.png" title="Adicionar Despesa" alt="Adicionar Despesa"></a>
				</div>
				<div class="dividir saldoAtual">
					Saldo Atual: R$ <?php echo $saldoAtual; ?>
				</div>
			</div>
			<br>
			<hr class="divideBig">
			<br>
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
						$sql = "SELECT * FROM categorias,lancamentos,cadastros $sqlTabela";
						$receber = $conectar -> prepare($sql);
						$receber -> execute();

						$contador = 1;
						foreach($receber as $listar){
							if($contador > 10){
								break;
							}else{
								$id = $listar['id'];
								$tipo = $listar['tipo']; 
								$previsao = $listar['previsao'];
								$efetivada = $listar['efetivada'];
								$id_categoria = $listar['nome'];
								$descricao = $listar['descricao'];
								$valor = $listar['valor'];
								$nome_usuario = $listar['nome_usuario'];
								$data_envio = $listar['data_envio'];
								
								$dataHoje = date('Ymd');
								$tempo = str_replace("-","",$previsao);
																
								if($efetivada == "0000-00-00"){
									
									if($tempo == $dataHoje){
										$classe = "hoje";
										$status = "Para Hoje";
									}
									if($tempo < $dataHoje){
										$classe = "atrasado";
										$status = "Atrasado";
									}
									if($tempo > $dataHoje){
										if($tempo <= $dataHoje + 7){
											$classe = "naSemana";
											$status = "Para Esta Semana";
										}else{
											$classe = "aPagar";
											$status = "A Pagar";
										}
									}
									
									$efetivada = "Não Efetivada";
								}else{
									$classe = "pago";
									$status = "Pago";
								}
								
								$previsao = date('d/m/Y', strtotime($previsao));
								$data_envio = date('d/m/Y', strtotime($data_envio));
								
								if($tipo == "D"){
									$imagemTipo = "menos.png";
								}else if($tipo = "R"){
									$imagemTipo = "mais.png";
								}else{
									$imagemTipo = "nenhum.png";
								}
								
								if($efetivada == "Não Efetivada"){
									$pagamento = "pagar";
									$ativar = "";
								}else{
								$efetivada = date('d/m/Y', strtotime($efetivada));
									$pagamento = "pago";
									$ativar = "disabled";
								}
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
										<td class='semCor'><input type='image' src='Imagens/editar.png' name='editar' title='Editar' onClick='editar($id, 1)'></td>
										<td class='semCor'><input type='image' src='Imagens/$pagamento.png' name='pagar' $ativar title='$titlePagamento' onClick='pagar($id, 1)'></td>
										<td class='semCor'><input type='image' src='Imagens/excluir.png' name='excluir' title='Excluir' onClick='excluir($id, 1)'></td>
									</tr>
								";
								$contador++;
							}
						}
					?>
				</table>
			</div>
		</div>
	</body>
</html>