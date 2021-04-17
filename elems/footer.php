<input type = 'submit' id = 'create' value = 'Создать пункт меню'>

<form method = 'post' id = 'form'>
    <p>Имя пункта меню: <input name = 'point_name'></p>
    <p>Зажмите Ctrl для выбора нескольких ролей:<br>
    <select multiple name = 'form_roles[]'>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/elems/values.php';  // Получаю $roles

foreach ($roles as $elem) {
    echo '<option class = \'form_roles\'>' . $elem . '</option>' . PHP_EOL;
}
?>

    </select></p>
    <input type = 'submit' value = 'создать'>
</form>