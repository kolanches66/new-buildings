<?php
session_start();
// только для авторизованных пользователей
if (!empty($_SESSION['login'])) {
	require_once '../../includes/config.php';
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
            require_once($inc_path.'/admin/parts/menu.php'); 
            construct_menu();
?>
        </div>
        
		<div id='main-wrapper'>
			<div id="content">   
<?php
			// РЕДАКТИРОВАНИЕ СПИСКА РАЙОНОВ
			if (!empty($_GET['list']) && $_GET['list'] == "districts") 
			{
				include($inc_path.'/db_connect.php');
				// если подключились к БД
				if (db_connect()) 
				{
					$query = 'SELECT * from districts';
					if ($result = $mysqli->query($query)) 
					{
?>
					<form action="" method="POST">
						<button class="button green">
						Добавить объект
						</button>
					</form>				

<?php
						// выводим результаты пока они есть
						while ($row = $result->fetch_assoc()) 
						{ 
?>
						<div>
							<span class=''><?=$row['district_id']?></span>
							<span class=''><?=$row['district_name']?></span>
						</div>
<?php
						}
					$result->free();
					}
					else echo "Не удалось выполнить запрос к БД";
				$mysqli->close();
				}
				else "Не удалось установить соединение с БД";
			}
			// отображаем доступные для редактирования списки
			else
			{ 
?>
				<a href="?list=cities">Список городов</a><br>
				<a href="?list=districts">Список районов</a><br>
<?php		} 
?>
			</div>
		</div>
<?php   
}
// если юзер не авторизован
else header("Location: login.php");
?>