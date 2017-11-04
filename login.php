<?php
	session_start();
	
	if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] || (! empty($_POST) && $_POST['user'] === 'admin' && $_POST['password'] === 'admin')) {
		$_SESSION['logged_in'] = true;
		header('Location: ./');
	}
	else {
?>

<html>
<head>
	<title>Login &#8249; xHome</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/login.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<script src="scripts/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<form method="post" name="login">
			<input type="text" name="user" id="user" class="field-top" placeholder="Nombre de usuario" value="" autofocus="" autocomplete="on" autocapitalize="none" autocorrect="off" required="required">
			
			<input type="password" name="password" id="password" value="" class="field-bottom" placeholder="Contraseña" autocomplete="on" autocapitalize="off" autocorrect="none" required="required">
			
			<input type="submit" id="submit" class="login primary icon-confirm-white" title="" value="Iniciar sesión">
			<div class="login-additional">
				<div class="remember-login-container">
					<input type="checkbox" name="remember_login" value="1" id="remember_login" class="checkbox checkbox--white">
					<label for="remember_login">Permanecer autenticado</label>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

<?php 
	}
?>