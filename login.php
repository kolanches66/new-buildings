<?php
	session_start();
	include('db_connect.php');
	// если пользователь ввел данные
	if (!empty($_POST['login']) && !empty($_POST['password'])) {
		// если они оказались правильными
		if ($_POST['login'] == "login" && $_POST['password'] == "password") {
			// то записываем пометку в сессию
			$_SESSION['login'] = 'login';
		}
	}
	if (empty($_SESSION['login'])) {
	?>
		<form action="login.php" method="POST">
			<p class="p_form"><input class="textbox" name="login" type="text"></p>
			<p class="p_form"><input class="textbox" name="password" type="password"></p>
			<p class="p_form"><input class="button submit" name="submit" type="submit"></p>
		</form>
	<?php
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>Новостройки: авторизация</title>
</head>
<body>
	<div id="content">
		
	</div>

</body>
<html>