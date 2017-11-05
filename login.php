<?php
	if (file_exists('config/config.php')) {
		require_once('config/config.php');
	} 
	else {
		header('Location: ./install.php');
	}

	require_once("./include/sql.php");

	function test_login($user, $passwd) {
		global $CONFIG;
		if ($user == $CONFIG['adminuser'] && password_verify ($passwd,$CONFIG['adminpass']) ) {
			return TRUE;
		}
		else {
			$conn = connect_sql();
			$query = "SELECT password
					  FROM " . $CONFIG["dbtableprefix"] . "users
					  WHERE id='" . $user . "';";
			$result = $conn->query($query);

			$correct = FALSE;
			if ($result && $result->num_rows === 1) {
				$row = $result->fetch_assoc();
				$correct = password_verify($passwd, $row["password"]);
				$result->close();
			}
			$conn->close();
			return $correct;
		}
	}

	session_start();
	
	if ( (isset($_SESSION['logged_in']) && $_SESSION['logged_in'])) {
		header('Location: ./');
	}
	else {

		if (!empty($_POST)){
			if ( test_login($_POST['user'], $_POST['password']) ) {
				$_SESSION['logged_in'] = TRUE;
				$_SESSION['user'] = $_POST['user'];
				header('Location: ./');
			} else {
				$warning = "Usuario o contraseña inválidos.";
			}
		}

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
		<div id="header">
			<div class="logo"></div>
		</div>
		<form method="post" name="login">
			<input type="text" name="user" id="user" class="field-top" placeholder="Nombre de usuario" value="<?php if (!empty($_POST)) echo $_POST["user"]; ?>" <?php if (empty($_POST)) echo "autofocus"?> autocomplete="on" autocapitalize="none" autocorrect="off" required="required">
			
			<input type="password" name="password" id="password" value="" class="field-bottom" placeholder="Contraseña" <?php if (!empty($_POST)) echo "autofocus"?> autocomplete="on" autocapitalize="off" autocorrect="none" required="required">

			<?php	
				if (isset($warning)){
					echo "<div class=\"warning\">" . $warning . "</div>";
				}
			?>
			
			<input type="submit" id="submit" class="login primary icon-confirm-white" title="" value="Iniciar sesión">
		</form>
	</div>
</body>
</html>

<?php
	}
?>