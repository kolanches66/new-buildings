<?php
	require_once $_SERVER["DOCUMENT_ROOT"].'/new_buildings/includes/config.php';
    require_once $inc_path.'vendor/autoload.php';

    $smarty = new Smarty();
	// коннектимся к базе
    include($inc_path.'db_connect.php');
	if (db_connect()) {
		$query = 'SELECT * from `buildings`';
		if ($result = $mysqli->query($query)) {
			while ($row = $result->fetch_assoc()) {
				$row['short_description'] = nl2br($row['short_description']);
				$smarty->append("buildings", $row);
			}
			$result->free();
		}
        else echo 'error';
        $mysqli->close();
		
		echo $smarty->display('demo.html');	
	}
?>