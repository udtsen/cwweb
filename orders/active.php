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
$sql = "SELECT  orders.id, orders.place_id, orders.user_id, orders.courier_id, orders.client_address, orders.be_ready, orders.client_phone, orders.payment, orders.price, orders.info, orders.dt_create, orders.dt_get, orders.dt_delivered, users.email, users.phone, users.first_name, users.last_name  FROM orders LEFT JOIN users ON orders.courier_id = users.id WHERE dt_delivered IS NULL";

if ($user['status'] == 'place') {
    $id = $user['id'];
    $sql = "SELECT orders.id, orders.place_id, orders.user_id, orders.courier_id, orders.client_address, orders.be_ready, orders.client_phone, orders.payment, orders.price, orders.info, orders.dt_create, orders.dt_get, orders.dt_delivered, users.email, users.phone, users.first_name, users.last_name FROM orders LEFT JOIN users ON orders.courier_id = users.id WHERE user_id = '$id' AND dt_delivered IS NULL";
}

$res = mysqli_query($conn, $sql);
$orders = [];
while ($row = mysqli_fetch_assoc($res)) {
    $orders[] = $row;
}

foreach ($orders as &$order) {
        $order['place_name'] = $places[$order['place_id']];        
    $order['courier_name'] = "Шукаємо";
    if ($order['courier_id']) {
        $order['courier_name'] = $order['first_name'] . " " . $order['last_name'];
    }
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
        <th>Кур'єр</th>
        <th <?php if($user['status'] == 'place'): ?> colspan='2' <?php endif; ?>>Кур'єр отримав о</th>
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
        <td>
            <?= $order['courier_name'] ?>
            <?php if($order['courier_id'] == NULL && $user['status'] == 'courier') { ?>
                <a href="/orders/get.php?order_id=<?=$order['id']?>">Взяти</a>
            <?php }elseif ($order['courier_id'] != NULL && $order['courier_id'] == $user['id']) { ?>
                <a class="btn btn-outline-success" href="/orders/reasign.php?order_id=<?=$order['id']?>">Перепризначити</a>
            <?php } ?>
        </td>
        <td><?= $order['dt_get'] ?></td>
        <?php if ($user['status'] == 'place'): ?><td><a href="/orders/cancel.php?order_id=<?=$order['id']?>" class="btn btn-outline-danger">Скасувати</a></td><?php endif; ?>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';