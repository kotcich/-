<table id = 'table'>
    <tr><th>Пункт меню</th><th>Привязанные роли</th><th>Привязать роль</th><th>Отвязать роль</th></tr>

    <?php
        require $_SERVER['DOCUMENT_ROOT'] . '/elems/values.php';  // Получаю $data для заполнения таблицы

        foreach ($data as $elem) {
            $elem_roles     = explode(',', $elem['roles']);  // Прикрепленные роли
            $notAttachRoles = array_diff($roles, $elem_roles);  // Не прикрепленные роли, $roles из value.php

            echo '<tr><td>' . $elem['point_name'] . '</td>' . PHP_EOL . '<td>';

            foreach ($elem_roles as $role) {
                echo '<span class = \'role\'>' . $role . '</span><br>';
            }

            echo '</td>'. PHP_EOL .'<td>';

            if (!empty($notAttachRoles)) {
                echo '<p><select data-role_id_plus = "'. $elem['point_id'] .'">';

                foreach ($notAttachRoles as $notAttachRole) {
                    echo '<option>' . $notAttachRole .'</option>' . PHP_EOL;
                }

                echo '</select></p>'. PHP_EOL .'
                <input type = \'submit\' class = \'plus\' data-point_id_plus = "'. $elem['point_id'] .'"
                value = \'привязать\'>'
                    . PHP_EOL;
            } else {
                echo 'Имеет все роли' . PHP_EOL;
            }

            echo '</td><td>';

        if (count($elem_roles) > 1) {
            echo "<p><select data-role_id_minus = '{$elem['point_id']}'>";

            foreach ($elem_roles as $for_delete_role) {
                echo '<option>' . $for_delete_role . '</option>';
            }

            echo "</select></p>
            <input type = 'submit' class = 'minus' data-point_id_minus = '{$elem['point_id']}' value = 'отвязать'>";
        } else {
            echo 'куда дальше то';
        }

        echo '</td></tr>' . PHP_EOL;
        }
    ?>

</table>