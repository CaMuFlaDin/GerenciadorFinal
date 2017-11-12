<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Gerenciador Financeiro</title>
		<link rel="icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/login.css">
	</head>
	<body>
		<form method="GET" action="Funcoes/login.php">
			<div class="login-form">
	    		<h1>GerFin</h1>
	     		<div class="form-group">
	       			<input type="text" name="usuario" placeholder="Nome de Usuário" class="input_login" autofocus>
	     		</div>
	     		<div class="form-group log-status">
	       			<input type="password" name="senha" placeholder="Senha" class="input_login">
	     		</div>
	     		<input type="submit" name="confirmar" value="Confirmar" class="button_login" style="cursor: pointer;"><br><br>
		</form>
		<a href="cadastrarUserLogin.php"><button form="" class="button_login" style="cursor: pointer;">Cadastrar</button></a>
			</div>
	</body>
</html>