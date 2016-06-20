<?php
session_start();
if (!empty($_SESSION['login'])) {
    include('../db_connect.php');
    if (db_connect()) {
            // если задано действие -- удалить
            if (!empty($_GET['action']) && $_GET['action'] == 'delete') {
                    // если задан id
                    if (!empty($_GET['id'])) {
                            $query = "DELETE from buildings WHERE id=?";
                            $id = $_GET['id'];
                            // выполняем запрос
                            if ($stmtDelete = $mysqli->prepare($query)) {
                                    $stmtDelete->bind_param("i",  $id);
                                    $stmtDelete->execute();
                                    echo $stmtDelete->error;
                                    $stmtDelete->close();
                            }
                            else {
                                    header("refresh: 3; url=index.php");
                                    echo 'Вы не можете удалить запись.';
                            }
                    }  //  (!empty($_GET['id']))
            } //  (!empty($_GET['action']) && $_GET['action'] == 'delete')

            $query = 'SELECT * from `buildings`';
            if ($result = $mysqli->query($query)) {
                    echo "<table class='table_catalog'>
                    <tr>
                    <th></th>
                    <th>Название</th>
                    <th>Район\область\регион</th>
                    <th>Описание</th>
                    </tr>";
                    while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td class='table_id'>
                                    <a href='edit.php?id=".$row['id']."'>редактировать</a><br>
                                    <a href='index.php?action=delete&id=".$row['id']."'>удалить</a>
                            </td>
                            <td class='table_name'>".$row['name']."</td>
                            <td class='table_location'>".$row['location']."</td>
                            <td class='table_description'>".nl2br($row['short_description'])."</td>
                            </tr>";
                    }
                    echo "</table>";
                    $result->free();
            }
            else echo 'error';
            $mysqli->close();
    }
}
else header("Location: index.php");