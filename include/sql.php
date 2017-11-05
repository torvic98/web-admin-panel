<?php
	function connect_sql () {
		global $CONFIG;
		$c = new mysqli($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpassword'], $CONFIG['dbname'], $CONFIG['dbport']);
		if ($c->connect_error) {
			 die("Connectin with database failed: " . $conn->connect_error);
		}
		else {
			return $c;
		}
	}
?>