<?php
$query      = "SELECT `name` FROM `roles`";
$result     = mysqli_query($link, $query) or die(musqli_error($link));
for ($roles = []; $row = mysqli_fetch_assoc($result)['name']; $roles[] = $row);

if ($edit == 'Роль') {
    $query = "SELECT points.point_id AS point_id, points.name AS point_name, GROUP_CONCAT(roles.name) AS `roles` FROM `points` JOIN
        `points_roles` ON points.point_id = points_roles.point_id JOIN `roles` ON
        points_roles.role_id = roles.role_id GROUP BY points.name ORDER BY point_id";
} else {
    $query = "SELECT points.point_id AS point_id, points.name AS point_name, GROUP_CONCAT(roles.name) AS `roles` FROM `points` JOIN
        `points_roles` ON points.point_id = points_roles.point_id JOIN
        `roles` ON points_roles.role_id = roles.role_id JOIN
        `points_roles` `points_roles2` ON points.point_id = points_roles2.point_id JOIN
        `roles` `roles2` ON points_roles2.role_id = roles2.role_id AND roles2.name = '$edit'
        GROUP BY points.name ORDER BY point_id";
}

$result = mysqli_query($link, $query) or die(musqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

$table .= '<tr><th>Пункт меню</th><th>Привязанные роли</th><th>Привязать роль</th><th>Отвязать роль</th></tr>';

foreach ($data as $elem) {
    $elem_roles = explode(',', $elem['roles']);  // Прикрепленные роли
    $notAttachRoles = array_diff($roles, $elem_roles);  // Не прикрепленные роли

    $table .= "<tr><td>{$elem['point_name']}</td><td>";

    foreach ($elem_roles as $role) {
        $table .= "<span class = 'role'>$role</span><br>";
    }

    $table .= '</td><td>';

    if (!empty($notAttachRoles)) {
        $table .= "<p><select data-role_id_plus = '{$elem['point_id']}'>";

        foreach ($notAttachRoles as $notAttachRole) {
            $table .= "<option>$notAttachRole</option>";
        }

        $table .= "</select></p><input type = 'submit' class = 'plus' data-point_id_plus = '{$elem['point_id']}'
            value = 'привязать'>";
    } else {
        $table .= 'Имеет все роли';
    }

    $table .= "</td><td>";

    if (count($elem_roles) > 1) {
        $table .= "<p><select data-role_id_minus = '{$elem['point_id']}'>";

        foreach ($elem_roles as $for_delete_role) {
            $table .= '<option>' . $for_delete_role . '</option>';
        }

        $table .= "</select></p>
                <input type = 'submit' class = 'minus' data-point_id_minus = '{$elem['point_id']}' value = 'отвязать'>";
    } else {
        $table .= 'куда дальше то';
    }

    $table .= '</td></tr>';
}

echo json_encode($table);