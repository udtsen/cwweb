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
<!-- Зміст сторінки "Контакти" -->
<div class="container mt-5">
  <h2>Контакти</h2>
  <div class="row">
    <div class="col-md-6">
        <p>Phone: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
        <p>Phone: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
        <p>Phone: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
        <p>Phone: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
        <p>Email: <a href="mailto:example@example.com">example@example.com</a></p>
        <p>Address: <a href="https://www.google.com/maps?q=San+Francisco,+CA,+USA" target="_blank">San Francisco, CA, USA</a></p>
    </div>
    <div class="col-md-6">
      <!-- Додайте вбудовану карту, якщо потрібно -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23162.731834965457!2d-0.12546582152560584!3d51.50485578805343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDU5JzU4LjMiTiAxMMKwMDknMTYuMyJF!5e0!3m2!1sen!2suk!4v1619268885272!5m2!1sen!2suk" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';
