<html>
    <head> <title> Добавление новой ОС </title> </head>
    <body>
        <H2>Добавление новой ОС</H2>
        <form action="save_new.php" method="get">
            Название: <input name="name" size="30" type="text">
            <br>Тип оборудования: <input name="type" size="30" type="text">
            <br>Разрядность: <input name="bitness" size="30" type="text">
            <br>Разработчик: <input name="developer" size="30" type="text">
            <br>Количество пользователей: <input name="users" size="30" type="text">

            <p>
                <input name="add" type="submit" value="Добавить">
                <input name="b2" type="reset" value="Очистить">
            </p>
        </form>
        <p><button style='color: blue' onclick="window.location.href='../index.php'">Вернуться к списку ОС</button></td></p>
    </body>
</html>