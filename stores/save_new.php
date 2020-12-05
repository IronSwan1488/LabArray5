<?php
    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno) {
        $name = $_GET['name'];
        $url = $_GET['url'];

        $result = $mysqli->query("INSERT INTO store SET name='$name', url='$url'");
    }

    header("Location: ../index.php");
    exit;
?>