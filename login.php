<?php
	include('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>Новостройки::авторизация</title>
</head>
<body>
	<div id="content">
	<?php
		$query = 'SELECT * from new_buildings';
		if ($result = $mysqli->query($query)) {
			echo "<table><th class='table_header'>id</th>
			<th class='table_header'>название</th>
			<th class='table_header'>район\область\регион</th>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
				<td class='table_id'>".$row['id']."</td>
				<td class='table_name'>".$row['name']."</td>
				<td class='table_location'>".$row['location']."</td>
				</tr>";
			}
			echo "</table>";
			$result->free();
		}
		?>
	</div>

</body>
<html>