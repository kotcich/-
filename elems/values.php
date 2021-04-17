<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/elems/db.php';

// Отдельный файл для того, чтобы не селектить одни и те же данные раз за разом в файлах:
// header/main/footer .php , то есть для загрузки данных в таблицу при первом заходе, до первого изменения

$query      = "SELECT `name` FROM `roles`";
$result     = mysqli_query($link, $query);
for ($roles = []; $row = mysqli_fetch_assoc($result)['name']; $roles[] = $row);

$query  = "SELECT points.point_id AS point_id, points.name AS point_name, GROUP_CONCAT(roles.name) AS `roles` FROM `points` INNER JOIN
`points_roles` ON points.point_id = points_roles.point_id INNER JOIN `roles` ON
points_roles.role_id = roles.role_id GROUP BY points.name ORDER BY point_id";
$result = mysqli_query($link, $query);
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);