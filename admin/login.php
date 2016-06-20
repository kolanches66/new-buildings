<?php
session_start();
// БЛОК ОБРАБОТКИ
// осуществляем проверку данных для авторизации
if (isset($_POST['btn_enter']) && empty($_SESSION['login'])) {
    // если юзер ввёл не все данные
    if (empty($_POST['login']) || empty($_POST['password'])) {
        $message_type = "info";
        $message_text = "Введите и логин, и пароль";
    }
    // или всё-таки ввёл все
    else {
        // проверяем их на правильность
        $error = false;
            // если они оказались правильными
            if ($_POST['login'] == "login" && $_POST['password'] == "password") 
            {
		// то делаем пометку в сессии
		$_SESSION['login'] = 'login';
                // чтобы не было повторной отправки формы при F5
                header("Location: index.php");
            }
            // а если неправильными, то -- ошибка
            else {
                $message_type = "error";
                $message_text = "Ошибка! Логин или пароль введены неверно.";
            }
    }
}
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
    // ...отпускаем это бедное животное на волю
    if (isset($_GET['action']) && $_GET['action'] == "logout") {
	// уничтожаем сессию
	session_unset ($_SESSION['login']);
        header("Location: index.php");
    }
    // если же он зашёл сюда просто так,
    // то наглым образом выпинываем его,
    // ибо проходимцы нам тут не нужны
    header("Location: index.php");
    // если он решил выйти
    /*if (isset($_GET['action']) && $_GET['action'] == "logout") {
	// уничтожаем нашу сессию
	session_unset ($_SESSION['login']);
        header("Location: index.php");
    } 
    // отображаем интерфейс авторизованного пользователя
    ?>
    <div id="content_pre">
        <?php require $_SERVER["DOCUMENT_ROOT"].'/new_buildings/parts/menu.php'; ?>
    </div>
    
    <div id="content">
        <a href='index.php?action=logout'>Выход</a>
    </div>
    
    <?php
    include('../db_connect.php');
    if (db_connect()) {
        <?php require $_SERVER["DOCUMENT_ROOT"].'/new_buildings/parts/menu.php'; ?>
    }*/
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
			<button class="button green" name="btn_enter" type="submit">Войти</button>
			</p>
        </form>
    </div>
<?php
}
?>

</body>
<html>