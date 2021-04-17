<?php
$host     = 'localhost';
$login    = 'root';
$password = 'Kotcich77';
$db       = 'task';

$link     = mysqli_connect($host, $login, $password, $db);

function vardump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}