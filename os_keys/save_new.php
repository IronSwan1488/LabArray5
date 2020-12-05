<?php
    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno) {
        $purchase_date = $_GET['purchase_date'];
        $expiry_date = $_GET['expiry_date'];
        $os_id = $_GET['os_id'];
        $store_id = $_GET['store_id'];
        $price = $_GET['price'];
        $key_code = $_GET['key_code'];

        $result = $mysqli->query("INSERT INTO os_keys
            SET purchase_date='$purchase_date',
            expiry_date='$expiry_date',
            os_id='$os_id',
            store_id='$store_id',
            price='$price',
            key_code='$key_code'"
        );
    }

    header("Location: ../index.php");
    exit;
?>