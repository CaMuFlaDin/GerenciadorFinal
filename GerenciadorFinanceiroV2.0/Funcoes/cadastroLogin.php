<?php
	session_start();
	if(isset($_POST['enviar'])){
		$id_usuario = "";
		$nome_usuario = $_POST['nome_usuario'];
		$senha = $_POST['senha'];
		$privilegio = "N";
		$data_inicio = date('Y-m-d');
		
		include "conectar.php";
		$sql = "INSERT INTO cadastros VALUES(?, ?, ?, ?, ?)";
		$enviar = $conectar -> prepare($sql);
		$enviar -> execute(array($id_usuario, $nome_usuario, $senha, $privilegio, $data_inicio));
		$enviar = null;
		
		echo "<script>
				alert('Cadastrado com sucesso!'); 
				window.location.replace('../index.php');
			  </script>";
	}
?>