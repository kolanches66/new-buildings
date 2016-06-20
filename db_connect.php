<?php
function db_connect() {
	global $mysqli;
	$db_user = "admin";
	$db_password = "PYQ63LyyyX69GKCc";
	$mysqli = new mysqli("localhost", $db_user, $db_password, "new_buildings");
	if ($mysqli->connect_errno) {
		echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
		return false;
	}
	// если всё ок
	else {
		$mysqli->set_charset("utf8");
		return true;
	}
}

?>