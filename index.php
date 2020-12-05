<html>
    <head> <title> Сведения </title> </head>

<!--
    Операционные системы (id, Название, тип оборудования, разрядность, разработчик, количество пользователей)

    8.1. Цифровые магазины (id, название, url)

    8.2. Цифровые ключи (id, дата приобретения, дата окончания, id ОС, id цифрового магазина, стоимость, ключ).
    Поля id игры и id цифрового магазина являются внешними ключами.
    При этом в одном Цифровом магазине может быть приобретено несколько цифровых ключей на одну и ту же игру.

    8.3. При удалении игры удаляются все ее цифровые ключи.

    8.4. При удалении цифрового магазина удаляются все цифровые ключи из этого магазина.

    8.5. Сформировать PDF и XLS-файлы, содержимым которых будут смежные таблицы Игры (№ п/п, Название,  тип оборудования,
    разрядность, разработчик, количество пользователей, цифровой ключ, дата приобретения, дата окончания, url магазина)
-->
    <h2>Список ОС</h2>
    <table border="1">
        <tr>
            <th> Название </th> <th> Тип оборудования </th> <th> Разрядность </th> <th> Разработчик </th> <th> Количество пользователей </th>
        </tr>
        <?php
            $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");

            $counter=0;
            if (!$mysqli->connect_errno) {
                $result = $mysqli->query("SELECT id, name, type, bitness, developer, users FROM OS");

                
                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $name = $row['name'];
                        $type = $row['type'];
                        $bitness = $row['bitness'];
                        $developer = $row['developer'];
                        $users = $row['users'];
    
                        echo "<tr>";
                        echo "<td>$name</td><td>$type</td><td>$bitness</td><td>$developer</td><td>$users</td>";
                        echo "<td><button style='color: blue' onclick=\"window.location.href='os/edit.php?id=$id'\">Редактировать</button></td>";
                        echo "<td><button style='color: blue' onclick=\"window.location.href='os/delete.php?id=$id'\">Удалить</button></td>";
                        echo "</tr>";
    
                        $counter++;
                    }
                }
            }

            print "</table>";
            print("<p>Всего ОС: $counter </p>");
        ?>
    <button style='color: blue' onclick="window.location.href='os/new.php'">Добавить ОС</button></td>


    <h2>Список магазинов</h2>
    <table border="1">
        <tr>
            <th> Название </th> <th> Адрес </th>
        </tr>
        <?php
            if (!$mysqli->connect_errno) {
                $result = $mysqli->query("SELECT id, name, url FROM store");

                $counter=0;
                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $name = $row['name'];
                        $url = $row['url'];
                    

                        $counter++;

                        echo "<tr>";
                        echo "<td>$name</td><td>$url</td>";
                        echo "<td><button style='color: blue' onclick=\"window.location.href='stores/edit.php?id=$id'\">Редактировать</button></td>";
                        echo "<td><button style='color: blue' onclick=\"window.location.href='stores/delete.php?id=$id'\">Удалить</button></td>";
                        echo "</tr>";
                    }
                }
            }
            print "</table>";
            print("<p>Всего магазинов: $counter </p>");
        ?>
    <button style='color: blue' onclick="window.location.href='stores/new.php'">Добавить магазин</button></td>

    <h2> Список ключей </h2>
    <table border="1">
        <tr>
            <th> Дата приобретения </th> <th> Дата окончания действия </th> <th> ОС </th>
            <th> Магазин </th> <th> Стоимость </th> <th> Ключ </th>
        </tr>
        <?php
            if (!$mysqli->connect_errno) {
                $result = $mysqli->query("SELECT
                    os_keys.id,
                    os_keys.purchase_date,
                    os_keys.expiry_date,
                    os_keys.price,
                    os_keys.key_code,

                    OS.name as os_name,
                    store.name as store_name

                    FROM os_keys
                    LEFT JOIN OS ON os_keys.os_id=OS.id
                    LEFT JOIN store ON os_keys.store_id=store.id"
                );

                $counter=0;
                if ($result){
                    while ($row = $result->fetch_array()){
                        $id = $row['id'];
                        $purchase_date = $row['purchase_date'];
                        $expiry_date = $row['expiry_date'];
                        $os_name = $row['os_name'];
                        $store_name = $row['store_name'];
                        $price = $row['price'];
                        $key_code = $row['key_code'];

                        $purchase_date = date('d-m-Y', strtotime($purchase_date));
                        $expiry_date = date('d-m-Y', strtotime($expiry_date));

                        echo "<tr>";
                        echo "<td>$purchase_date</td><td>$expiry_date</td><td>$os_name</td><td>$store_name</td><td>$price</td><td>$key_code</td>";
                        echo "<td><button style='color: blue' onclick=\"window.location.href='os_keys/edit.php?id=$id'\">Редактировать</button></td>";
                        echo "<td><button style='color: blue' onclick=\"window.location.href='os_keys/delete.php?id=$id'\">Удалить</button></td>";
                        echo "</tr>";

                        $counter++;
                    }
                }
            }
            print "</table>";
            print("<p>Всего ключей: $counter </p>");
        ?>
    <button style='color: blue' onclick="window.location.href='os_keys/new.php'">Добавить ключ</button></td>

    <p>
        <button onclick="window.location.href='gen_pdf.php'">PDF-версия таблицы операционных систем</button>
        <button onclick="window.location.href='gen_xls.php'">XML-версия таблицы операционных систем</button>
    </p>
</html>