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
		<form enctype="multipart/form-data" action="upload.php" method="POST">
			<p class="p_submit">Отправка файла</p>
			<p class="p_submit"><input name="userfile" type="file" /></p>
			<p class="p_submit"><input class="button_submit" type="submit" value="Отправить файл" /></p>
		</form>
	</div>
	

</body>
<html>