<?php
session_start();
// только для авторизованных пользователей
if (!empty($_SESSION['login'])) {
    include($_SERVER["DOCUMENT_ROOT"].'/new_buildings/db_connect.php');
    if (db_connect()) {
        // БЛОК ОБРАБОТКИ
        // выполняем добавление данных в БД, если нажали кнопку
        if (isset($_POST['submit'])) {
            $query = "INSERT INTO buildings (name, short_description, description) VALUES(?, ?, ?)";
            $name = $_POST['name'];
            $short_description = $_POST['short_description'];
            $description = $_POST['description'];
            if ($stmtUpdate = $mysqli->prepare($query)) {
                $stmtUpdate->bind_param("sss", $name, $short_description, $description);
                $stmtUpdate->execute();
                echo $stmtUpdate->error;
                $stmtUpdate->close();
                header("Location: index.php");
            }
            // если запрос не удался
                else {
                    header("refresh: 3; url=index.php");
                    echo 'Не получилось изменить запись.';
                }
        }

            // БЛОК ИНТЕРФЕЙСА
            ?>
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
                <h1 class="header">Добавить объект</h1>
				<div id="content">
                <form action='' method='POST'>
                        <p class='p_form'><label for='id'>Название объекта</label></br>
                        <input class='textbox big' type='text' name='name' value=''></p>

                        <p class='p_form'><label for='short_description'>Краткое описание объекта</label></br>
                        <textarea class='textarea big' name='short_description' value=''></textarea></p>

                        <p class='p_form'><label for='description'>Полное описание объекта</label></br>
                        <textarea class='textarea enormous' name='description' value=''></textarea></p>

                        <p class='p_form'><button class="button green" name='submit' type='submit'>Добавить</button></p>
                </form>
            </div></div>
            </body>
            </html>
    <?php
    }
    // если соединение с базой провалилось
    else header("Location: login.php");
}
else header("Location: login.php");
?>
