<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <title>Новостройки: главная</title>
</head>
<body>
	<?php require_once('parts/menu.php'); ?>

	<div id="content">
		
		<p class="p_submit">
		<input class="button green" type="button" value="Добавить объект" onclick="location.href='add.php'"/>
		</p>
	
	<?php
		include('db_connect.php');
		
		/* if (!empty($_GET['id'])) {
			// входные данные
			$id = $_GET['id'];
			$query = "SELECT `text` FROM `to_delete` WHERE id=?";
			// создаем подготавливаемый запрос
			if ($stmt = $mysqli->prepare($query)) {
				// связываем параметры с метками 
				$stmt->bind_param("i", $id);
				// запускаем запрос
				$stmt->execute();
				// связываем переменные с результатами запроса
				$stmt->bind_result($text);
				// получаем значения
				$stmt->fetch();
				echo $id.' '.$text;
				/// закрываем запрос
				$stmt->close();
			}

		// закрываем соединение 
		$mysqli->close();
		}*/
	
	
		$query = 'SELECT * from new_buildings';
		if ($result = $mysqli->query($query)) {
			echo "<table class='table_catalog'>
			<tr>
			<th>ID</th>
			<th>Название</th>
			<th>Район\область\регион</th>
			<th>Описание</th>
			</tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
				<td class='table_id'>".$row['id']."</td>
				<td class='table_name'>".$row['name']."</td>
				<td class='table_location'>".$row['location']."</td>
				<td class='table_description'>".nl2br($row['short_description'])."</td>
				</tr>";
			}
			echo "</table>";
			$result->free();
		}
		$mysqli->close();
		?>
	</div>

</body>
<html>