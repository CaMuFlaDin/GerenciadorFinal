<?php
	if(isset($_GET['atualizar'])){
		$id = $_GET['id'];
		$nome_usuario = htmlspecialchars(utf8_encode($_GET['nome']));
		$senha = htmlspecialchars(utf8_encode($_GET['senha']));
		$privilegio = htmlspecialchars(utf8_encode($_GET['privilegio']));
				
		include "conectar.php";
		$sql = "UPDATE cadastros
				SET nome_usuario = ?,
				senha = ?,
				privilegio = ?
				WHERE id_usuario = $id
		";
		$atualizar = $conectar -> prepare($sql);
		$atualizar -> execute(array($nome_usuario, $senha, $privilegio));
		$atualizar = null;
		
		echo "
			<script>
				alert('Atualizado com sucesso!');
				window.location.replace('../listarLancamentos.php');
			</script>
			";
	}
?>