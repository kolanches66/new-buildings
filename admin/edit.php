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
				$row = $result->fetch_assoc(); ?>
				<!DOCTYPE html>
				<html>
				<head>
					<meta charset="utf-8">
					<link rel="stylesheet" href="../style.css">
					<title>Новостройки: панель управления</title>
				</head>
				<body>

				<div id="top-wrapper">
				<?php 
                    // строим меню
                    require_once('parts/menu.php'); 
                    construct_menu();
                ?>
                </div>
                                
                <div id='main-wrapper'>
					<h1 class='header'>Редактирование объекта</h1>
					<div id="content">    
					<form action='' method='POST'>			
						<p class='p_form'>
						<label for='id'>Название объекта</label></br>
						<input class='textbox big' type='text' name='name' value='<?php echo $row['name']; ?>'></p>

						<p class='p_form'>
						<label for='short_description'>Краткое описание объекта</label></br>
						<textarea class='textarea big' name='short_description' value=''>
							<?php echo $row['short_description']; ?>
						</textarea></p>

						<p class='p_form'>
						<label for='description'>Полное описание объекта</label></br>
						<textarea class='textarea big' name='description' value=''>
							<?php echo $row['description']; ?>
						</textarea></p>

						<p class='p_form'>
						<button class='button green' name='submit' type='submit'>
						Добавить объект
						</button>
						</p>
					</form>
				</div></div>
			<?php
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