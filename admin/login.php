<?php
session_start();
// БЛОК ОБРАБОТКИ
// осуществляем проверку данных для авторизации
// если нажал кнопку для входа и ещё не авторизваон
if (isset($_POST['btnEnter']) && empty($_SESSION['login'])) {
    // если ввёл не все данные
    if (empty($_POST['login']) || empty($_POST['password'])) {
        $message_type = "info";
        $message_text = "Введите и логин, и пароль";
    }
    // или всё-таки ввёл все
    else 
	{
        // проверяем их на правильность
		$login = $_POST['login'];
		$pass = $_POST['password'];
		require '../db_connect.php';
		// подключение к базе
		if (db_connect()) {
			$query = "SELECT * FROM `users` WHERE login=? AND pass_hash=? LIMIT 1";
			if ($stmt = $mysqli->prepare($query)) 
			{
				$stmt->bind_param("ss", $login, $pass);
				$stmt->execute();
				$result = $stmt->get_result();
				//$num_of_rows = $result->num_rows;
				// если такая запись нашлась
				if ($result->num_rows == 1) 
				{
					// делаем пометку в сессии
					$_SESSION['login'] = 'login';
					// чтобы не было повторной отправки формы при F5
					header("Location: index.php");
				}
				// а если такой записи нет, то ЯК, -- ошибка
				else {
					$message_type = "error";
					$message_text = "Ошибка! Логин или пароль введены неверно.";
				}
			}  //  end of if ($stmt = $mysqli->prepare($query))
			// а если такой записи нет, то ЯК, -- ошибка
			else {
				$message_type = "error";
				$message_text = "Ошибка запроса к БД";
			}
		}  //  end of if (db_connect())
	}  // конец: если ввёл все данные
}  //  if (isset($_POST['btnEnter']) && empty($_SESSION['login']))
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <title>Новостройки: панель управления</title>
</head>
<body>

<?php
// если юзер каким-то непонятным образом здесь,
// то только по одной причине
if (!empty($_SESSION['login'])) {
    // он уходит...
    // ...отпускаем это бедное животное на волю, если оно желает
    if (isset($_GET['action']) && $_GET['action'] == "logout") {
	// уничтожаем сессию
	session_unset ($_SESSION['login']);
        header("Location: index.php");
    }
    // если же он зашёл сюда просто так,
    // то наглым образом выпинываем его,
    // ибо проходимцы нам тут не нужны
    header("Location: index.php");
}

// а если не зашёл, то
else {  ?>
	<div id="main-wrapper">
		<h1 class='header'>Авторизация</h1>
		<div id="content">
        <?php	
        // вывод сообщений об ошибке, если они есть
        if (!empty($message_type) && !empty($message_text)) {
            echo '<div class="message '.$message_type.'">'.$message_text.'</div>';
        }
        ?>
        <form action="" method="POST">
            <p class="p_form"><label for='login'>Логин</label><br>
			<input class="textbox big" name="login" type="text"></p>
			
            <p class="p_form"><label for='login'>Пароль</label><br>
			<input class="textbox big" name="password" type="password"></p>
			
            <p class="p_form">
			<button class="button green" name="btnEnter" type="submit">Войти</button>
			</p>
        </form>
    </div>
<?php
}
?>

</body>
<html>