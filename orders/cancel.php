<?php
$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';
$conn = include "../core/dbconnect.php";
if ($user['status'] == 'place') {
    $order_id = $_GET['order_id'];
    var_dump(mysqli_query($conn, "UPDATE orders SET dt_delivered = CURRENT_TIMESTAMP() WHERE id = $order_id"));
}
header("Location: /orders/active.php");