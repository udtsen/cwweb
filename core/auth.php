<?php

$conn = include "dbconnect.php";

$user = null;
$token = $_COOKIE['token'] ?? null;

if ($token !== null) {
    $sql = "SELECT * FROM sessions WHERE token = '$token'";
    $session = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $session === false ? null : $session;

    if ($session !== null) {
        $id = $session['id_user'];
        $sql = "SELECT `id`, `email`, `phone`, `first_name`, `last_name`, `transport_type`, `status` FROM users WHERE id = '$id'";
        $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    }

    if ($user === null) {
        setcookie('token', '', time() - 3600, '/');
    }
    
}
return $user;
