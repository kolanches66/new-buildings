<?php
	session_start();
	//include('db_connect.php');
	// если пользователь решил уйти
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		// только если сессия существует, уничтожаем её
		if (isset($_SESSION['login'])) session_unset ($_SESSION['login']);
		// но в любом случае кидаем юзера обратно на login.php
		header('Location: login.php');
	}
	$error = false;
	// если пользователь ввел данные
	if (!empty($_POST['login']) && !empty($_POST['password'])) {
		// если они оказались правильными
		if ($_POST['login'] == "login" && $_POST['password'] == "password") {
			// то записываем пометку в сессию
			$_SESSION['login'] = 'login';
		}
		else $error = true;
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

	<div id="navigation">
		<nav>
			<a class="link nav_link" href="/new_buildings/">главная</a>::<a 
			class="link nav_link" href="#">каталог</a>::<a 
			class="link nav_link" href="#">помощь</a>
		</nav>
	</div>

	<div id="content" class="autorization">
<?php	// нажали кнопку
		if (isset($_POST['submit'])) {
			// если юзер ввёл не все данные
			if (empty($_POST['login']) || empty($_POST['password'])) 
				echo '<div class="message info">Введите и логин, и пароль</div>';
			// или всё-таки ввёл все
			else {
				if (!empty($_POST['login']) && !empty($_POST['password']) && $error)  
					echo '<div class="message error">Ошибка! Логин или пароль введены неверно.</div>';
					// если юзер ввел не все данные
			}
		}

		// если юзер ещё не зашёл на сайт
		if (empty($_SESSION['login'])) { 
?>			<form action="login.php" method="POST">
				<p class="p_form"><input class="textbox autorization" name="login" type="text"></p>
				<p class="p_form"><input class="textbox autorization" name="password" type="password"></p>
				<p class="p_form"><input class="button submit" name="submit" type="submit"></p>
			</form><?php 
		} else { ?>
			<a href="login.php?action=logout">Выход</a>
<?php 
		}
?>
	</div>

</body>
<html>