<?php
	//include('db_connect.php');
	if (isset($_POST['submit'])) {
		$blacklist = array(".php", ".phtml", ".php3", ".php4", ".php5", ".php6", ".php7");
		$isScript = false;
		foreach ($blacklist as $item) {
			if(preg_match("/$item\$/i", $_FILES['userfile']['name'])) {
				$isScript = true;
				echo "Нельзя загружать PHP-скрипты\n";
			}
		}
		if (!$isScript) {
			if ($_FILES['userfile']['type'] == "image/jpeg" || 
				$_FILES['userfile']['type'] == "image/png" ||
				$_FILES['userfile']['type'] == "image/gif") 
			{
				$tmp_file = $_FILES['userfile']['tmp_name'];
				//print_r(getimagesize($tmp_file));
				$uploaddir = '/wamp/www/new_buildings/uploads/';
				$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
					//$image = imagecreatefrompng($tmp_file);
					$image = imagecreatefromjpeg($tmp_file);
					imagejpeg($image, "1.jpg", 0);
					imagejpeg($image, "2.jpg", 10);
					imagejpeg($image, "3.jpg", 50);
					imagejpeg($image, "4.jpg", 100);
					echo '<img src="1.jpg" width="800px"><br>';
					echo '<img src="2.jpg" width="800px"><br>';
					echo '<img src="3.jpg" width="800px"><br>';
					echo '<img src="4.jpg" width="800px">';
				//echo '<pre>';
				//if (move_uploaded_file(, $uploadfile)) {
				//	echo "Файл корректен и был успешно загружен.\n";
				//} 
				//else echo "Возможная атака с помощью файловой загрузки!\n";
				//echo 'Некоторая отладочная информация:';
				//print_r($_FILES);
				//echo '</pre>';
			}
			else echo "Неправильный формат файла!";
		}
	}
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="content">
		<!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
		<form enctype="multipart/form-data" action="" method="POST">
			<p class="p_submit">Отправка файла</p>
			<p class="p_submit"><input name="userfile" type="file" /></p>
			<p class="p_submit"><input class="button_submit" name="submit" type="submit" value="Отправить файл" /></p>
		</form>
	</div>
	

</body>
<html>