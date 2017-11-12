<?php
	if(isset($_GET['conf'])){
		if($_GET['conf'] == 1){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				
				include "conectar.php";
				$sql = "SELECT * FROM lancamentos WHERE id_categoria=$id";
				$receber = $conectar -> prepare($sql);
				$receber -> execute();
				foreach($receber as $comparar){
					$id_categoria = $comparar['id_categoria'];
					if($id = $id_categoria){
						$erro = 1;
					}
				}
				if($erro == 1){
					echo"<script>alert('É necessário que não haja ocorrências dessa categoria em nenhum lançamento!')</script>";
				}else{
				$sql = "DELETE FROM categorias WHERE id_categoria=$id";
				$excluir = $conectar -> prepare($sql);
				$excluir -> execute();
				$excluir = null;
				}
			}
		}
	}
	echo "<script>window.location.replace('../categorias.php')</script>";
?>