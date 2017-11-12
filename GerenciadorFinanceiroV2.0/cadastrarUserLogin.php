<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Gerenciador Financeiro</title>
		<link rel="icon" href="Imagens/logo.png">
		<link rel="stylesheet" href="Estilos/login.css">
		<script src="Funcoes/confirmar.js"></script>
	</head>
	<body>
		<form method="POST" action="Funcoes/cadastroLogin.php">
			<div class="login-form">
	    		<h1>GerFin</h1>
	    		<h4>Cadastro</h4>
	     		<div class="form-group">
	       			<input type="text" name="nome_usuario" placeholder="Nome de Usuário" class="input_login" required autofocus>
	     		</div>
	     		<div class="form-group log-status">
	       			<input type="password" name="senha" placeholder="Senha" class="input_login" required>
	     		</div>
	     		<input type="submit" name="enviar" value="Cadastrar" class="button_login" style="cursor: pointer;"><br><br>
	   		</div>
		</form>
	</body>
</html>