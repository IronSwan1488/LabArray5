<html>
    <head> <title> Редактирование данных о ключе </title> </head>
    <h2>Редактирование данных о ключе</h2>
    <body>
        <form action='save_edit.php' method='get'>
            <?php
                $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
                if (!$mysqli->connect_errno) {
                    $key_id = $_GET['id'];

                    $result = $mysqli->query("SELECT
                        os_keys.purchase_date,
                        os_keys.expiry_date,
                        os_keys.price,
                        os_keys.key_code,

                        OS.id as os_id,
                        OS.name as os_name,

                        store.id as store_id,
                        store.name as store_name

                        FROM os_keys
                        LEFT JOIN OS ON os_keys.os_id=OS.id
                        LEFT JOIN store ON os_keys.store_id=store.id
                        WHERE os_keys.id=$key_id"
                    );

                    if ($result && $st = $result->fetch_array()){
                        $purchase_date = $st['purchase_date'];
                        $expiry_date = $st['expiry_date'];
                        $price = $st['price'];
                        $key_code = $st['key_code'];


                        $os_id = $st['os_id'];
                        $os_name = $st['os_name'];

                        $store_id = $st['store_id'];
                        $store_name = $st['store_name'];
                    }
                }

                print "Дата приобретения: <input name='purchase_date' size='30' type='date' placeholder='dd-mm-yyyy' value='$purchase_date'>";
                print "<br>Дата окончания действия: <input name='expiry_date' size='30' type='date' placeholder='dd-mm-yyyy' value='$expiry_date'>";

                $result = $mysqli->query("SELECT id, name FROM OS WHERE id<>$os_id");
                echo "<br>ОС: <select name='os_id'>";
                echo "<option selected value='$os_id'>$os_name</option>";

                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $name = $row['name'];

                        echo "<option value='$id'>$name</option>";
                    }
                }
                echo "</select>";

                $result = $mysqli->query("SELECT id, name FROM store WHERE id<>$store_id");
                echo "<br>Магазин: <select name='store_id'>";
                echo "<option selected value='$store_id'>$store_name</option>";

                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $name = $row['name'];

                        echo "<option value='$id'>$name</option>";
                    }
                }
                echo "</select>";

                print "<br>Стоимость: <input name='price' size='30' type='text' value='$price'>";
                print "<br>Ключ: <input type='text' name='key_code' size='30' value='$key_code'>";
                print "<input type='hidden' name='id' size='30' value='$key_id'>";
            ?>
            <p><input type='submit' name='save' value='Сохранить'></p>
        </form>
        <p><button style='color: blue' onclick="window.location.href='../index.php'">Вернуться к списку ключей</button></td></p>
    </body>
</html>