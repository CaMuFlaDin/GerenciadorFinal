<?php
	session_start();
	if(isset($_GET['confirmar'])){
		$usuario = $_GET['usuario'];
		$senha = $_GET['senha'];
		
		include "conectar.php";
		$sql = "SELECT * FROM cadastros";
		$receber = $conectar -> prepare($sql);
		$receber -> execute();
		
		foreach($receber as $comparar){
			$id_usuario = $comparar['id_usuario'];
			$usuarioComp = $comparar['nome_usuario'];
			$senhaComp = $comparar['senha'];
			$privilegio = $comparar['privilegio'];
			
			if(($usuario == $usuarioComp) && ($senha == $senhaComp)){
				$_SESSION['id'] = $id_usuario;
				$_SESSION['nome'] = $usuario;
				$_SESSION['senha'] = $senha;
				$_SESSION['privilegio'] = $privilegio;
				$_SESSION['login'] = true;
				header("Location: ../listarLancamentos.php");
			}else{
				echo "<script>
						alert('Login incorreto!');
						window.location.replace('../index.php');
					 </script>"; 
			}
		}
	}
?>