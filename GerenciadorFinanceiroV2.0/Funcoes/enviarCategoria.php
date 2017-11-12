<?php
	if(isset($_GET['enviarCategoria'])){
		$id = "";
		$nome = htmlspecialchars(utf8_encode($_GET['nome']));
		$tipo = htmlspecialchars(utf8_encode($_GET['tipo']));
	
		include "conectar.php";
		$sql = "INSERT INTO categorias VALUES(?,?,?)";
		$enviar = $conectar -> prepare($sql);
		$enviar -> execute(array($id, $nome, $tipo));
	}
	echo"<script>window.location.replace('../categorias.php')</script>";
?>