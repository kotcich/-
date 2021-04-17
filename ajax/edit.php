<?php
if (isset($_GET['role'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/elems/db.php';
    $edit  = mysqli_real_escape_string($link, $_GET['role']);
    $table = '';

    require $_SERVER['DOCUMENT_ROOT'] . '/elems/table.php';
}