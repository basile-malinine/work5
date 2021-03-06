    <div class="container">
        <div class="text-header">Уважаемый работодатель!</div>
        <p>Приложение написано на чистом PHP, весь код написан собственными руками, не без “погуглить”, конечно, но основная идея авторская. Для создания приложения использовались:</span></p>
        <ul>
            <li>PHP 8.0.12</li>
            <li>Сервер базы данных MySql 8.0.27</li>
            <li>WEB-сервер Apache 2.4 (локально)</li>
            <li>Среда разработки PhpStorm 2022.1.2</li>
        </ul>
        <p>Основной WEB-каталог <span class="f-code">/work5</span>. Если удобнее другое имя, можно переименовать, это не принципиально. В корне основного каталога расположены следующие подкаталоги:</p>
        <ul>
            <li><span class="f-code">css</span> &dash; таблицы стилей</li>
            <li><span class="f-code">database</span> &dash; файлы для доступа к БД MySql сервера</li>
            <li><span class="f-code">helpers</span> &dash; модули "облегчающие жизнь" (валидация форм, класс доступа к БД приложения)</li>
            <li><span class="f-code">pages</span> &dash; подключаемые (require) страницы и формы</li>
        </ul>
        <p>Для работы приложения необходимо создать и настроить базу данных. Выполните следующие шаги:</p>
        <ul>
            <li>На сервере MySql создайте пустую базу данных с произвольным названием</li>
            <li>Сделайте импорт из скрипта <span class="f-code">/database/users.sql</span></li>
            <li>Отредактируйте файл <span class="f-code">/database/dbconfig.php</span> (конфигурация MySql)</li>
        </ul>
        <p>После импорта скрипта в исходной базе уже есть один пользователь. Логин: <span class="f-code">admin</span> Пароль: <span class="f-code">admin</span></p>
    </div>
