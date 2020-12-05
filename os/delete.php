<?php
    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno) {
        $id = $_GET['id'];
        $result = $mysqli->query("DELETE FROM OS WHERE id='$id'");
    }

    header("Location: ../index.php");
    exit;
?>