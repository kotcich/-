<?php
if (isset($_GET['plus']) and isset($_GET['point_id']) and isset($_GET['role'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/elems/db.php';

    $plus     = mysqli_real_escape_string($link, $_GET['plus']);
    $edit     = mysqli_real_escape_string($link, $_GET['role']);
    $point_id = (int)$_GET['point_id'];
    $table    = '';

    $query = "INSERT INTO `points_roles` (`point_id`, `role_id`) VALUES ($point_id,
    (SELECT `role_id` FROM `roles` WHERE `name` = '$plus'))";
    mysqli_query($link, $query) or die(mysqli_error($link));

    require $_SERVER['DOCUMENT_ROOT'] . '/elems/table.php';
}