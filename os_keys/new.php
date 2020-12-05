<html>
    <head> <title> Добавление нового ключа </title> </head>
    <body>
        <H2>Добавление нового ключа</H2>
        <form action="save_new.php" method="get">
            Дата приобретения: <input name="purchase_date" size="30" placeholder="dd-mm-yyyy" type="date">
            <br>Дата окончания действия: <input name="expiry_date" size="30" placeholder="dd-mm-yyyy" type="date">
            <?php
                $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
                if ($mysqli->connect_errno) {
                    echo "Не удалось подключиться к БД";
                }

                $result = $mysqli->query("SELECT id, name FROM OS");
                echo "<br>ОС: <select name='os_id'>";

                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $name = $row['name'];

                        echo "<option value='$id'>$name</option>";
                    }
                }
                echo "</select>";

                $result = $mysqli->query("SELECT id, name FROM store");
                echo "<br>Магазин: <select name='store_id'>";

                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $name = $row['name'];

                        echo "<option value='$id'>$name</option>";
                    }
                }
                echo "</select>";
            ?>
            <br>Стоимость: <input name="price" size="30" type="text">
            <br>Ключ: <input name="key_code" size="30" type="text">
            <p>
                <input name="add" type="submit" value="Добавить">
                <input name="b2" type="reset" value="Очистить">
            </p>
        </form>
        <p><button style='color: blue' onclick="window.location.href='../index.php'">Вернуться к списку ключей</button></td></p>
    </body>
</html>