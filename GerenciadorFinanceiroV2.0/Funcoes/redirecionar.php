<?php 
	if(isset($_POST['editar'])){
		header("Location: ../editar.php?conf=1");
	}
	if(isset($_POST['pagar'])){
		header("Location: ../pagar.php?conf=1");
	}
	if(isset($_POST['excluir'])){
		header("Location: ../excluir.php?conf=1");
	}
?>