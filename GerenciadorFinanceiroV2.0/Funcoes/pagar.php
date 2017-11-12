<?php
	if(isset($_GET['conf'])){
		if($_GET['conf'] == 1){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$data = date('Y-m-d');
				include "conectar.php";
				$sql = "UPDATE lancamentos
						SET efetivada = ? 
						WHERE id = $id";
				$pagar = $conectar -> prepare($sql);
				$pagar -> execute(array($data));
			}
		}
		switch($_GET['pagina']){
			case 1:
				echo "<script>window.location.replace('../listarLancamentos.php')</script>";
				break;
			case 2:
				echo "<script>window.location.replace('../atrasados.php')</script>";
				break;
			case 3:
				echo "<script>window.location.replace('../totalPendente.php')</script>";
				break;
			case 4:
				echo "<script>window.location.replace('../outrosLancamentos.php')</script>";
				break;
		}
	}
	echo "<script>window.location.replace('../listarLancamentos.php')</script>";
?>