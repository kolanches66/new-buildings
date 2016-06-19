<?php
	include('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>Новостройки: добавление</title>
</head>
<body>

	<div id="navigation">
		<nav>
			<a class="link nav_link" href="/new_buildings/">главная</a>::<a 
			class="link nav_link" href="#">каталог</a>::<a 
			class="link nav_link" href="#">помощь</a>
		</nav>
	</div>
	
	<div id="content_pre">
		<h1 class="content_header">Добавление объекта</h1>
	</div>
	
	<div id="content">
		<form enctype="multipart/form-data" action="add_query.php" method="POST">
		
			<p class="p_form"><label for="object_name">Название объекта</label><br>
			<input class="textbox object_name" name="object_name" type="text"></p>
			
			<p class="p_form"><label for="object_location">Район\область\регион</label><br>
			<input class="textbox object_location" name="object_location" type="text"></p>
			
			<p class="p_form"><label for="object_description">Описание</label><br>
			<textarea class="textarea object_description" name="object_description" type="text"></textarea></p>
			
			<p class="p_submit"><input class="file_block" name="userfile" type="file" /></p>
			
			<input class="button submit" type="button" value="Опубликовать">

		</form>
	</div>

</body>
<html>