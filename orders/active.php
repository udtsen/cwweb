<?php
ob_start();
$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';
$conn = include "../core/dbconnect.php";

$id = $user['id'];
$sql = "SELECT id, name FROM places WHERE user_id = '$id'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $places[$row['id']] = $row['name'];
}

$sql = "SELECT * FROM orders WHERE dt_delivered IS NULL";

if ($user['status'] == 'place') {
    $id = $user['id'];
    $sql = "SELECT * FROM orders WHERE user_id = '$id' AND dt_delivered IS NULL";
}

$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $orders[] = $row;
}

foreach ($orders as &$order) {
    $order['place_name'] = $places[$order['place_id']];
}
?>

<table class="table" width="100%">
    <tr>
        <th>Назва закладу</th>
        <th>Адреса клієнта</th>
        <th>Номер клієнта</th>
        <th>Буде готове о</th>
        <th>Оплата кур'єром</th>
        <th>Ціна доставки</th>
        <th>Додаткова інформація</th>
        <th>Створено</th>
        <th>Кур'єр отримав о</th>
    </tr>
    <?php foreach($orders as $order): ?>
        <td><?= $order['place_name'] ?> </td>
        <td><?= $order['client_address'] ?></td>
        <td><?= $order['client_phone'] ?></td>
        <td><?= $order['be_ready'] ?></td>
        <td><?= $order['payment'] ?></td>
        <td><?= $order['price'] ?></td>
        <td><?= $order['info'] ?></td>
        <td><?= $order['dt_create'] ?></td>
        <td><?= $order['dt_get'] ?></td>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';