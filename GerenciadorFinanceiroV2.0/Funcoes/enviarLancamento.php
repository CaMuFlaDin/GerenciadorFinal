<?php
	session_start();
	if(isset($_GET['adicionar'])){
		$id = "";
		
		$tipo = htmlspecialchars($_GET['tipo']);
		$previsao = htmlspecialchars($_GET['previsao']);
		$efetivada = "0000-00-00";
		$categoria = htmlspecialchars($_GET['categoria']);
		$descricao = htmlspecialchars($_GET['descricao']);
		$valor = htmlspecialchars($_GET['valor']);
		$id_usuario = $_SESSION['id'];
		$envio = date('Y-m-d');
		
		if($tipo == "R"){
			$efetivada = $previsao;
		}
		
		echo $id."<br>";
		echo $tipo."<br>";
		echo $previsao."<br>";
		echo $efetivada."<br>";
		echo $categoria."<br>";
		echo $descricao."<br>";
		echo $valor."<br>";
		echo $id_usuario."<br>";
		echo $envio."<br>";
		
		include "conectar.php";
		$sql = "INSERT INTO lancamentos VALUES(?,?,?,?,?,?,?,?,?)";
		$enviar = $conectar -> prepare($sql);
		$enviar -> execute(array($id, $tipo, $previsao, $efetivada, $categoria, $descricao, $valor, $id_usuario, $envio));
		$enviar = null;
		header("Location: ../listarLancamentos.php");
	}else{
		header("Location: ../listarLancamentos.php");
	}
?>