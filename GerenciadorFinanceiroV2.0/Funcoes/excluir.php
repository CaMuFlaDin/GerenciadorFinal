<?php
	if(isset($_GET['conf'])){
		if($_GET['conf'] == 1){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				include "conectar.php";
				$sql = "DELETE FROM lancamentos WHERE id=$id";
				$excluir = $conectar -> prepare($sql);
				$excluir -> execute();
				$excluir = null;
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