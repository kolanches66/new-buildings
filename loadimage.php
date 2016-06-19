<?php
	include('db_connect.php');
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
		<form enctype="multipart/form-data" action="__URL__" method="POST">
			<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
			<!-- Название элемента input определяет имя в массиве $_FILES -->
			<p class="p_submit">Отправить этот файл:</p>
			<p class="p_submit"><input name="userfile" type="file" /></p>
			<p class="p_submit"><input class="button_submit" type="submit" value="Отправить файл" /></p>
		</form>
	</div>
	

</body>
<html>