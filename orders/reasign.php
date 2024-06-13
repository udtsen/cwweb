<?php
$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';
$conn = include "../core/dbconnect.php";
if ($user['status'] == 'courier') {
    $id = $user['id'];
    $order_id = $_GET['order_id'];
    mysqli_query($conn, "UPDATE orders SET courier_id = NULL WHERE order_id = $order_id");
}
header("Location: /orders/active.php");