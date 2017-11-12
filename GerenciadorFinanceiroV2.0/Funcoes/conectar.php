<?php
	try{
		$conectar = new PDO("mysql:host=localhost;dbname=gerenciador_financeiro","root","");
	}
	catch(PDOException $e){
		echo $e -> getMessage();
	}
?>