<select id = 'roles'><option>Роль</option>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/elems/values.php';

foreach ($roles as $elem) {
    echo '<option>' . $elem . '</option>' . PHP_EOL;  // Использую одинарные кавычки, так они быстрее
}
?>

</select>