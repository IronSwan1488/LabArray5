<html>
    <head> <title> Редактирование данных о магазине </title> </head>
    <h2>Редактирование данных о магазине</h2>
    <body>
        <form action='save_edit.php' method='get'>
            <?php
                $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
                if (!$mysqli->connect_errno) {
                    $id = $_GET['id'];

                    $result = $mysqli->query("SELECT name, url FROM store WHERE id='$id'");

                    if ($result){
                        while ($st = $result->fetch_array()) {
                            $name = $st['name'];
                            $url = $st['url'];
                        }
                    }
                }

                print "Название: <input name='name' size='30' type='text' value='$name'>";
                print "<br>URL: <input name='url' size='30' type='text' value='$url'>";
                print "<input type='hidden' name='id' size='30' value='$id'>";
            ?>
            <p><input type='submit' name='save' value='Сохранить'></p>
        </form>
        <p><button style='color: blue' onclick="window.location.href='../index.php'">Вернуться к списку магазинов</button></td></p>
    </body>
</html>