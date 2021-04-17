<?php
if (isset($_GET['minus']) and isset($_GET['point_id']) and isset($_GET['role'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/elems/db.php';

    $minus    = mysqli_real_escape_string($link, $_GET['minus']);
    $edit     = mysqli_real_escape_string($link, $_GET['role']);
    $point_id = (int)$_GET['point_id'];
    $table    = '';

    $query = "DELETE FROM `points_roles` WHERE `point_id` = $point_id AND `role_id` =
    (SELECT `role_id` FROM `roles` WHERE `name` = '$minus')";
    mysqli_query($link, $query) or die(mysqli_error($link));

    require $_SERVER['DOCUMENT_ROOT'] . '/elems/table.php';
}