<?php
include($_SERVER["DOCUMENT_ROOT"].'/new_buildings/db_connect.php');
// если подключились к БД
if (db_connect()) {
    // БЛОК ОБРАБОТКИ
    // если выбрана какая-то запись из БД
    if (!empty($_GET['id'])) {
        // входные данные
	$id = $_GET['id'];
		
	// выполняем запись данных в БД, если необходимо
	if (isset($_POST['submit'])) {
            $query = "UPDATE buildings SET name=?, short_description=?, description=? WHERE id=? LIMIT 1";
            $name = $_POST['name'];
            $short_description = $_POST['short_description'];
            $description = $_POST['description'];
            if ($stmtUpdate = $mysqli->prepare($query)) {
		$stmtUpdate->bind_param("sssi", $name, $short_description, $description, $id);
		$stmtUpdate->execute();
		echo $stmtUpdate->error;
		$stmtUpdate->close();
            }
            else {
		header("refresh: 3; url=index.php");
		echo 'Ошибка при изменении записи.';
            }
        }
		
		$query = "SELECT * FROM `buildings` WHERE id=? LIMIT 1";
		// создаем подготавливаемый запрос
		if ($stmt = $mysqli->prepare($query)) {
			// связываем параметры с метками 
			$stmt->bind_param("i", $id);
			// запускаем запрос
			$stmt->execute();
			// пишем результат и количество полученных записей 
			$result = $stmt->get_result();
                        // общее кол-во записей (либо 0, либо 1)
			$num_of_rows = $result->num_rows;
			// если запись найдена, то выводим её
			if ($num_of_rows == 1) {
				$row = $result->fetch_assoc();
				echo "<form action='' method='POST'>			
				<p><label for='id'>Название объекта</label></br>
				<input type='text' name='name' value='".$row['name']."'></p>
				
				<p><label for='short_description'>Краткое описание объекта</label></br>
				<textarea name='short_description' value=''>".$row['short_description']."</textarea></p>
				
				<p><label for='description'>Полное описание объекта</label></br>
				<textarea name='description' value=''>".$row['description']."</textarea></p>
				
				<p><input name='submit' type='submit'></p>
				</form>
				";
			}
			// если такой записи нет, то уходим отсюда
			else if ($num_of_rows == 0) {
				$stmt->free_result();
				$stmt->close();
				$mysqli->close();
				header('Location: index.php');
			}
			$stmt->free_result();
			$stmt->close();
		}  //  if ($stmt = $mysqli->prepare($query))
	// закрываем соединение 
	$mysqli->close();
	}
        // если никакая запись не выбрана
	else header('Location: index.php');
}
// если подключение к базе не удалось
else header('Location: index.php');
?>