<html>
    <head> <title> Добавление нового магазина </title> </head>
    <body>
        <H2>Добавление нового магазина:</H2>
        <form action="save_new.php" method="get">
            Название: <input name="name" size="30" type="text">
            <br>URL: <input name="url" size="30" type="text">

            <p>
                <input name="add" type="submit" value="Добавить">
                <input name="b2" type="reset" value="Очистить">
            </p>
        </form>

        <p><button style='color: blue' onclick="window.location.href='../index.php'">Вернуться к списку магазинов</button></td></p>
    </body>
</html>