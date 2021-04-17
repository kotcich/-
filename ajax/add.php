<?php
if (isset($_GET['role'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/elems/db.php';

    $name  = mysqli_real_escape_string($link, $_POST['point_name']);
    $edit  = mysqli_real_escape_string($link, $_GET['role']);
    $roles = $_POST['form_roles'];
    $table = '';

    mysqli_query($link, "INSERT INTO points SET `name` = '$name'");
    $point_id = mysqli_insert_id($link);

    for ($i = 0; $i < count($roles); $i++) {
        mysqli_query($link, "INSERT INTO `points_roles` (`point_id`, role_id) VALUES ($point_id, (SELECT `role_id` FROM
        `roles` WHERE `name` = '$roles[$i]'))");
    }

    /* Да, гораздо правильнее будет к примеру передать id полученных ролей (в value.php) и указать их в data атрибуте
    Но я тут захотел  пофлексить :D умением в подзапросы */

    /* И еще, насколько я знаю, делать запросы к бд в цикле допускается, если это не селекты которые выполняются
    при каждом заходе на страницу, а к примеру операции, которые выполняются редко (как добавление новой записи
    как здесь) */

    require $_SERVER['DOCUMENT_ROOT'] . '/elems/table.php';
}