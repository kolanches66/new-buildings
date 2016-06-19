<?php
	include('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>Новостройки: главная</title>
</head>
<body>

	<div id="navigation">
		<nav>
			<a class="link nav_link" href="/new_buildings/">главная</a>::<a 
			class="link nav_link" href="#">каталог</a>::<a 
			class="link nav_link" href="#">помощь</a>
		</nav>
	</div>

	<div id="content">
		
		<p class="p_submit">
		<input class="button green" type="button" value="Добавить объект" onclick="location.href='add.php'"/>
		</p>
	
	<?php
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
		?>
	</div>

</body>
<html>