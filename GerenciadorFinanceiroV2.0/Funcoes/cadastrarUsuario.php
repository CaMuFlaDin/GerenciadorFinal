<?php
	session_start();
	if($_SESSION['login'] != true){
		echo"<script>window.location.replace('index.php')</script>";
	}
	if(isset($_POST['enviar'])){
		$id_usuario = "";
		$nome = $_POST['nome'];
		$senha = $_POST['senha'];
		$privilegio = $_POST['privilegio'];
		$data_inicio = date('Y-m-d');
		
		include "conectar.php";
		$sql = "INSERT INTO cadastros VALUES(?, ?, ?, ?, ?)";
		$enviar = $conectar -> prepare($sql);
		$enviar -> execute(array($id_usuario, $nome, $senha, $privilegio, $data_inicio));
		$enviar = null;
		
		echo "<script>
				alert('Cadastrado com sucesso!'); 
				window.location.replace('../listarLancamentos.php');
			  </script>";
	}
?>