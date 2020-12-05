<?php
    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno) {
        $id = $_GET['id'];

        $name = $_GET['name'];
        $type = $_GET['type'];
        $bitness = $_GET['bitness'];
        $developer = $_GET['developer'];
        $users = $_GET['users'];

        $result = $mysqli->query("UPDATE OS
            SET name='$name',
            type='$type',
            bitness='$bitness',
            developer='$developer',
            users='$users'
            WHERE id='$id'"
        );
    }

    header("Location: ../index.php");
    exit;
?>