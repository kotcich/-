let create  = document.querySelector('#create');
let form    = document.querySelector('#form');
let roles   = document.querySelector('#roles');
let table   = document.querySelector('#table');
let i       = 0;  // Переменная для ограничения выполнения эвента, так как я получаю нужные мне элементы через table

// Показать форму
function show()
{
    form.style.display = 'block';
    create.value = 'Скрыть';
    create.removeEventListener('click', show);
    create.addEventListener('click', hide);
}

// Скрыть форму
function hide()
{
    form.style.display = 'none';
    create.value = 'Создаит пункт меню';
    create.removeEventListener('click', hide);
    create.addEventListener('click', show);
}

// Появление формы по клику на кнопку
create.addEventListener('click', show);

// Добавление нового пункта меню
form.addEventListener('submit', function(e)
{
    let promise1 = fetch('/ajax/add.php?role=' + roles.value, {
        method: 'POST',
        body: new FormData(this),
    });

    promise1
        .then(
            data => { return data.json() }
        )
        .then(
            result => { table.innerHTML = result }
        )

    e.preventDefault();
});

// Вывод таблицы на основе выделенной роли
roles.addEventListener('click', function ()
{
    let promise2 = fetch('/ajax/edit.php?role=' + roles.value);

    promise2
        .then(
            data => { return data.json() }
        )
        .then(
            result => { table.innerHTML = result }
        )
});

// Да, я выкрутился :D (Получаю дочернии элементы)
table.addEventListener('mousedown', function()
{
    let pluses  = document.querySelectorAll('.plus');
    let minuses = document.querySelectorAll('.minus');
    i++;

    if (i == 1)
    {
        // Добавление роли к пункту с последующим выводом новых данных в таблицу
        for (let plus of pluses)
        {
            plus.addEventListener('click', function ()
            {
                let point_id_plus = plus.dataset.point_id_plus;  // Получение id пункта установленного к кнопке
                let notAttachRoles = document.querySelector(`[data-role_id_plus="${point_id_plus}"]`);
                let promise3 = fetch('/ajax/plus.php?plus=' + notAttachRoles.value + '&point_id=' + point_id_plus
                + '&role=' + roles.value);
                i = 0;

                promise3
                    .then(data => {
                        return data.json()
                    })
                    .then(result => {
                        table.innerHTML = result
                    })
            });
        }

        // Отвязываю роль от пункта с последующим выводом новых данных в таблицу
        for (let minus of minuses)
        {
            minus.addEventListener('click', function()
            {
                let point_id_minus = minus.dataset.point_id_minus;  // Получение id пункта установленного к кнопке
                let AttachRoles    = document.querySelector(`[data-role_id_minus="${point_id_minus}"]`);
                let promise4       = fetch('/ajax/minus.php?minus=' + AttachRoles.value + '&point_id=' +
                    point_id_minus + '&role=' + roles.value);
                i = 0;

                promise4
                    .then(data => {
                        return data.json()
                    })
                    .then(result => {
                            table.innerHTML = result
                    })
            });
        }
    }
});