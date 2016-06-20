<?php
	require_once $_SERVER["DOCUMENT_ROOT"].'/new_buildings/includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css">
    <title>Новостройки: главная</title>
</head>
<body>
	<?php require_once('parts/menu.php'); ?>
	<div id="main-wrapper">
		<div id="content">
		<?php
		include('db_connect.php');
		if (db_connect()) {
			$query = 'SELECT * from buildings';
			if ($result = $mysqli->query($query)) {
				// выводим результаты пока они есть
				while ($row = $result->fetch_assoc()) { ?>
					<div>
						<!--<td class='table_id'><?=$row['id']?></td>-->
						<span class='table_name'><?=$row['name']?></span>
						<span class='table_location'><?=$row['short_description']?></span>
						<span class='table_description'><?=nl2br($row['description'])?></span>
					</div>
				<?php
				}
				$result->free();
			}
			$mysqli->close();
		}
		?>
		</div>
	</div>

</body>
<html>