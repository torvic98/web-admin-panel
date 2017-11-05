<?php
	error_reporting(E_ERROR | E_PARSE);

	function init_sql($CONFIG, &$warning) {
		$conn = new mysqli($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpassword'], "",$CONFIG['dbport']);

		if ($conn->connect_error) {
			$warning = "Connection with server failed: " . $conn->connect_error;
			$conn->close();
			return FALSE;
		}
		
		$query = "CREATE DATABASE IF NOT EXISTS " . $CONFIG['dbname'];
		if ($conn->query($query) !== TRUE) {
			$warning = "Error creating database: " . $conn->error;
			$conn->close();
			return FALSE;
		} 
			
		$conn->select_db($CONFIG['dbname']);

		if ($conn->connect_error) {
			$warning = "Connection with database failed: " . $conn->connect_error;
			$conn->close();
			return FALSE;
		}

		$query = "CREATE TABLE IF NOT EXISTS " 
			. $CONFIG['dbtableprefix'] . "users (
					id VARCHAR(16) NOT NULL PRIMARY KEY, 
					password VARCHAR(255) NOT NULL,
					firstname VARCHAR(30) NOT NULL,
					lastname VARCHAR(30) NOT NULL,
					email VARCHAR(50),
					groups TEXT,
					reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					last_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
								 ON UPDATE CURRENT_TIMESTAMP
					)";

		if ($conn->query($query) !== TRUE) {
			$warning = "Error creating table 'users': " . $conn->error;
			$conn->close();
			return FALSE;
		}

		$query = "CREATE TABLE IF NOT EXISTS " 
		. $CONFIG['dbtableprefix'] . "groups (
				id VARCHAR(10) NOT NULL PRIMARY KEY,
				description VARCHAR(20) NOT NULL
				)";

		if ($conn->query($query) !== TRUE) {
			$warning = "Error creating table 'groups': " . $conn->error;
			$conn->close();
			return FALSE;
		}

		$query = "CREATE TABLE IF NOT EXISTS " 
			. $CONFIG['dbtableprefix'] . "menus (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				position INT(6) UNSIGNED,
				path VARCHAR(255) NOT NULL,
				description VARCHAR(20) NOT NULL,
				icon VARCHAR(30) NOT NULL DEFAULT 'radio_button_checked',
				groups_allowed TEXT
				)";

		if ($conn->query($query) !== TRUE) {
			$warning = "Error creating table 'menus': " . $conn->error;
			$conn->close();
			return FALSE;
		}
		
		$conn->close();
		return TRUE;
	}

	if (file_exists('config/config.php')) {
		// File exists: some components may failed.
		header('Location: ./');
	}
	else {
		// First configuration
		if (!file_exists('config/config.sample.php')) {
			exit("Not found: config.sample.php");
		}
		else {
			require('config/config.sample.php');

			if (!empty($_POST)) {
				$CONFIG['adminuser'] = $_POST['adminuser'];
				$CONFIG['adminpass'] = password_hash($_POST['adminpass'], PASSWORD_DEFAULT);

				$CONFIG['trusted_domains'] = array( 0 => $_SERVER['SERVER_NAME'], );
				$CONFIG['datadirectory'] = getcwd();

				$CONFIG['dbname'] = $_POST['dbname'];
				$CONFIG['dbhost'] = $_POST['dbhost'];
				if (empty($_POST['dbport'])) {
					$CONFIG['dbport'] = ini_get("mysqli.default_port");
				}
				else {
					$CONFIG['dbport'] = $_POST['dbport'];
				}
				$CONFIG['dbtableprefix'] = $_POST['dbtableprefix'];
				$CONFIG['dbuser'] = $_POST['dbuser'];
				$CONFIG['dbpassword'] = $_POST['dbpassword'];

				if (init_sql($CONFIG, $warning)) {
					// Data base has been created
					// All configuration done
					$CONFIG['installed'] = true;
					$file_content = "<?php\n" .
									var_export($CONFIG, true)
									. ";\n?>";
					file_put_contents('config/config.php', $file_content);
					header('Location: ./');
				}
			}

?>

<html>
<head>
	<title>Install &#8249; xHome</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/login.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<script src="scripts/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<div id="header">
			<div class="logo">
			</div>
		<form method="post" name="login">
			<input type="text" name="adminuser" id="adminuser" class="field-top" placeholder="Usuario administrador" value="<?php if (!empty($_POST)) echo $_POST["adminuser"]; ?>" autofocus="" autocomplete="on" autocapitalize="none" autocorrect="off" required="required" pattern="[\w0-9]*" maxlength="16">
			
			<input type="password" name="adminpass" id="adminpass" value="<?php if (!empty($_POST)) echo $_POST["adminpass"]; ?>" class="field-bottom" placeholder="Contraseña" autocomplete="on" autocapitalize="off" autocorrect="none" required="required" pattern=".{8,}">

			<input type="text" name="dbname" id="dbname" class="field-top" placeholder="Nombre base de datos" value="<?php if (!empty($_POST)) echo $_POST["dbname"]; ?>" autofocus="" autocomplete="off" autocapitalize="none" autocorrect="off" required="required">
			
			<input type="text" name="dbhost" id="dbhost" class="field-middle" placeholder="URL" value="<?php if (!empty($_POST)) echo $_POST["dbhost"]; ?>" autofocus="" autocomplete="off" autocapitalize="none" autocorrect="off" required="required">

			<input type="text" name="dbport" id="dbport" class="field-middle" placeholder="Puerto" value="<?php if (!empty($_POST)) echo $_POST["dbport"]; ?>" autofocus="" autocomplete="off" autocapitalize="none" autocorrect="off" pattern="[0-9]{0,5}">

			<input type="text" name="dbtableprefix" id="dbtableprefix" class="field-bottom" placeholder="Prefijo de tablas" value="<?php if (!empty($_POST)) echo $_POST["dbtableprefix"]; ?>" autofocus="" autocomplete="off" autocapitalize="none" autocorrect="off" pattern="[\w0-9]*" maxlength="5">

			<input type="text" name="dbuser" id="dbuser" class="field-top" placeholder="Usuario base de datos" value="<?php if (!empty($_POST)) echo $_POST["dbuser"]; ?>" autofocus="" autocomplete="off" autocapitalize="none" autocorrect="off" required="required">

			<input type="password" name="dbpassword" id="dbpassword" value="<?php if (!empty($_POST)) echo $_POST["dbpassword"]; ?>" class="field-bottom" placeholder="Contraseña base de datos" autocomplete="on" autocapitalize="off" autocorrect="none" required="required" pattern=".{8,}">
			
			<?php	
				if (isset($warning)){
					echo "<div class=\"warning\">" . $warning . "</div>";
				}
			?>

			<input type="submit" id="submit" class="login primary icon-confirm-white" title="" value="Continuar">
		</form>
	</div>
</body>
</html>

<?php
		}
	}
?>