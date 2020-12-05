<?php
    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno) {
        $id = $_GET['id'];

        $name = $_GET['name'];
        $url = $_GET['url'];

        $result = $mysqli->query("UPDATE store SET name='$name', url='$url' WHERE id='$id'");
    }

    header("Location: ../index.php");
    exit;
?>