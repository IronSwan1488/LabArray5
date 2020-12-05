<html>
    <head> <title> Редактирование данных об ОС </title> </head>
    <h2>Редактирование данных об ОС</h2>
    <body>
        <form action='save_edit.php' method='get'>
            <?php
                $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
                if ($mysqli->connect_errno) {
                    echo "Не удалось подключиться к БД";
                }

                $id = $_GET['id'];

                $result = $mysqli->query("SELECT name, type, bitness, developer, users FROM OS WHERE id='$id'");

                if ($result && $row = $result->fetch_array()){
                    $name = $row['name'];
                    $type = $row['type'];
                    $bitness = $row['bitness'];
                    $developer = $row['developer'];
                    $users = $row['users'];
                }

                print "Название: <input name='name' size='30' type='text' value='$name'>";
                print "<br>Тип оборудования: <input name='type' size='30' type='text' value='$type'>";
                print "<br>Разрядность: <input name='bitness' size='30' type='text' value='$bitness'>";
                print "<br>Разработчик: <input name='developer' size='30' type='text' value='$developer'>";
                print "<br>Количество пользователей: <input type='text' name='users' size='30' value='$users'>";
                print "<input type='hidden' name='id' size='30' value='$id'>";
            ?>
            <p><input type='submit' name='save' value='Сохранить'></p>
        </form>
        <p><button style='color: blue' onclick="window.location.href='../index.php'">Вернуться к списку ОС</button></td></p>
    </body>
</html>