<?php
	session_start();
	if ($_SESSION['logged_in'] !== TRUE) {
	   header("Location: ./login.php");
	   exit();
	} 
	else {
		$conn = connect_sql();
		$query = "SELECT id, guid
				  FROM " . $CONFIG['dbtableprefix'] . "users
				  WHERE id='" . $_SESSION["user"] . "';";
		$result = $conn->query($query);

		$guid = '';
		if ($result->num_rows === 1) {
			$row = $result->fetch_assoc();
			$guid = $row["guid"];
		} else if ($result === FALSE) {
			echo "Error: " . $conn->error;
		}

		$path = "./" . substr($_SERVER["SCRIPT_FILENAME"], strlen($CONFIG['datadirectory']) + 1); 
		$query = "SELECT id, groups_allowed
				  FROM " . $CONFIG['dbtableprefix'] . "menus
				  WHERE path='" . $path . "';";
		$result = $conn->query($query);

		$allowed = FALSE;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$groups_allowed = explode ( ",", $row["groups_allowed"]);
				if (in_array($guid, $groups_allowed) !== FALSE){
					$allowed = TRUE;
				}
			}
		} else if ($result === FALSE) {
			echo "Error: " . $conn->error;
		}
		$conn->close();

		if (!$allowed) {
			header('HTTP/1.0 403 Forbidden');
			exit();
		}
	}

?>