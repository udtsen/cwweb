<?php
$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';
$conn = include "../core/dbconnect.php";
if ($user['status'] == 'courier') {
    $id = $user['id'];
    mysqli_query($conn, "UPDATE orders SET courier_id = $id");
}
header("Location: /orders/active.php");