<?php
include('db_connect.php');
// выбираем привилегии
if (db_connect()) {
	// выполняем добавление данных в БД, если нажали кнопку
	if (isset($_POST['submit'])) {
		$query = "INSERT INTO buildings (name, short_description, description) VALUES(?, ?, ?)";
		$name = $_POST['name'];
		$short_description = $_POST['short_description'];
		$description = $_POST['description'];
		if ($stmtUpdate = $mysqli->prepare($query)) {
			$stmtUpdate->bind_param("sss", $name, $short_description, $description);
			$stmtUpdate->execute();
			echo $stmtUpdate->error;
			$stmtUpdate->close();
		}
	}

	// выводим форму   
	?>
	
	<form action='' method='POST'>
		<p><label for='id'>Название объекта</label></br>
		<input type='text' name='name' value=''></p>

		<p><label for='short_description'>Краткое описание объекта</label></br>
		<textarea name='short_description' value=''></textarea></p>

		<p><label for='description'>Полное описание объекта</label></br>
		<textarea name='description' value=''></textarea></p>

		<p><input name='submit' type='submit'></p>
	</form>
<?php
}
else header("Location: index.php");
?>
