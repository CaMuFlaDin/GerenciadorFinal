<?php
	if(isset($_GET['atualizar'])){
		$id = $_GET['id'];
				
		$nome = htmlspecialchars($_GET['nome']);
		$tipo = htmlspecialchars($_GET['tipo']);
		
		include "conectar.php";
		$sql = "UPDATE categorias
				SET nome = ?,
				tipo = ?
				WHERE id_categoria=$id;
				";
		$enviar = $conectar -> prepare($sql);
		$enviar -> execute(array($nome, $tipo));
		$enviar = null;
	}
	echo "<script>window.location.replace('../categorias.php')</script>";
?>