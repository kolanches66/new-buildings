<?php
session_start();
// только для авторизованных пользователей
if (!empty($_SESSION['login'])) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/new_buildings/includes/config.php';
	// коннектимся к базе
    include($inc_path.'/db_connect.php');
    // подключение удалось; иначе -- кидаем отсюда пользователя
    if (db_connect()) {
        // БЛОК ОБРАБОТКИ
        // если задано действие "удалить"
        if (!empty($_GET['action']) && $_GET['action'] == 'delete') {
            // если задан id записи
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $query = "DELETE from users WHERE id=?";
                // выполняем запрос
                if ($stmtDelete = $mysqli->prepare($query)) {
                    $stmtDelete->bind_param("i",  $id);
                    $stmtDelete->execute();
                    echo $stmtDelete->error;
                    $stmtDelete->close();
                }
                // если запрос не удался
                else {
                    header("refresh: 3; url=index.php");
                    echo 'Не получилось удалить запись.';
                }
            }  //  (!empty($_GET['id']))
        } //  (!empty($_GET['action']) && $_GET['action'] == 'delete')
        
    // БЛОК ИНТЕРФЕЙСА
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?=$web_path?>style.css">
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
        <div id="content">    
            <p class="p_submit">
                <button class="button green" onclick="location.href='add.php'">
                Добавить объект
                </button>
            </p>
            <?php
            $query = 'SELECT * from `users`';
            if ($result = $mysqli->query($query)) {
                    echo "<table class='table'>
                    <tr>
                    <th></th>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
					<th>Время регистрации</th>
					<th>Тип пользователя</th>
                    </tr>";
                    while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td class='table_id'>
                                <a class='link' href='edit.php?id=".$row['id']."'>редактировать</a><br>
                                <a class='link' href='index.php?action=delete&id=".$row['id']."'>удалить</a>
                            </td>
                            <td class='login'>".$row['login']."</td>
                            <td class='first_name'>".$row['first_name']."</td>
                            <td class='last_name'>".$row['last_name']."</td>
							<td class='datetime'>".$row['datetime']."</td>
							<td class='type'>".$row['type']."</td>
                            </tr>";
                    }
                    echo "</table></div></div>"
                    . "</body></html>";
                    $result->free();
            }
            else echo 'error';
            $mysqli->close();
    }
}
// если юзер не авторизован
else header("Location: login.php");