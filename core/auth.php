<?php

$conn = include "dbconnect.php";

$user = null;
$token = $_COOKIE['token'] ?? null;

if ($token !== null) {
    $sql = "SELECT * FROM sessions WHERE token = '$token'";
    $session = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $session === false ? null : $session;

    var_dump($session);
    die();

    if ($session !== null) {
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        
    }

    if ($user === null) {
        unset($_SESION['token']);
        setcookie('token', '', time() - 3600, BASE_URL);
    }

    var_dump($session);
}

