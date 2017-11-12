<?php
	if(isset($_GET['conf'])){
		if($_GET['conf'] == 1){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				
				include "conectar.php";
				$sql = "SELECT * FROM cadastros WHERE id_usuario=$id";
				$receber = $conectar -> prepare($sql);
				$receber -> execute();
				foreach($receber as $comparar){
					$id_usuario = $comparar['id_usuario'];
				}
				$sql = "DELETE FROM cadastros WHERE id_usuario=$id";
				$excluir = $conectar -> prepare($sql);
				$excluir -> execute();
				$excluir = null;
			}
		}
	}
	echo "<script>window.location.replace('../gerenciarUsuarios.php')</script>";
?>