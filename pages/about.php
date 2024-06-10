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
$sql = "SELECT * FROM orders LEFT JOIN users ON orders.courier_id = users.id WHERE dt_delivered IS NULL";

if ($user['status'] == 'place') {
    $id = $user['id'];
    $sql = "SELECT * FROM orders LEFT JOIN users ON orders.courier_id = users.id WHERE user_id = '$id' AND dt_delivered IS NULL";
}

$res = mysqli_query($conn, $sql);

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
<!-- Зміст сторінки "Про нас" -->
<div class="container mt-5">
  <h2>Про нас</h2>
  <p>Сервіс доставки їжі - це інноваційний сервіс, який забезпечує швидку та надійну доставку смачної їжі прямо до вашого дверей.</p>
  <p>Наша мета - зробити ваше життя більш комфортним, шляхом надання послуги доставки ваших улюблених страв з різноманітних закладів безпосередньо до вашого дому або офісу.</p>
  <p>Ми пильно дбаємо про якість наших послуг та пропонуємо доступні ціни для наших клієнтів. Наші кур'єри швидко та безпечно доставлять ваше замовлення в зручний для вас час.</p>
</div>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';
