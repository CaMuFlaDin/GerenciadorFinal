<?php
	if(isset($_GET['atualizar'])){
		$id = $_GET['id'];
		$tipo = $_GET['tipo'];
		$valor = htmlspecialchars(utf8_encode($_GET['valor']));
		$descricao = htmlspecialchars($_GET['descricao']);
		$previsao = htmlspecialchars(utf8_encode($_GET['previsao']));
		
		include "conectar.php";
		$sql = "UPDATE lancamentos
				SET valor = ?,
				descricao = ?,
				previsao = ?
				WHERE id = $id
		";
		$atualizar = $conectar -> prepare($sql);
		$atualizar -> execute(array($valor, $descricao, $previsao));
		$atualizar = null;
		
		echo "
			<script>
				alert('Atualizado com sucesso!');
				window.location.replace('../listarLancamentos.php');
			</script>
			";
	}
?>