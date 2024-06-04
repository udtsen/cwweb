<?php 
ob_start();
$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';

$conn = include "../core/dbconnect.php";
$id = $_GET['id'];
$sql = "SELECT * FROM places WHERE id = '$id'";
$place = mysqli_fetch_assoc(mysqli_query($conn, $sql));
if ($place['user_id'] != $user['id']) {
    header("Location: /pages/profile/place.php");
}
?>

<h2><?= $place['name'] ?></h2>
<h3>Створити замовлення</h3>

<form method="post">
    <div class="form-group">
        <label for="client_address">Адреса клієнта:</label>
        <input type="text" class="form-control" id="client_address" name="client_address" placeholder="Вкажіть адресу">
    </div>
    <div class="form-group">
        <label for="be_ready">Буде готове о:</label>
        <input type="text" class="form-control" id="be_ready" name="be_ready" placeholder="Вкажіть час">
    </div>
    <div class="form-group">
        <label for="client_phone">Номер клієнта:</label>
        <input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="Вкажіть номер">
    </div>
    <div class="form-group">
        <label for="payment">Кур'єр має оплатити:</label>
        <input type="text" class="form-control" id="payment" name="payment" placeholder="Залиште пустим, якщо без оплати">
    </div>
    <div class="form-group">
        <label for="price">Ціна доставки:</label>
        <input type="text" class="form-control" id="price" name="price">
    </div>
    <div class="form-group">
        <textarea name="info" class="form-control" id="info" rows="3" placeholder="Додаткова інформація(необов'язково)"></textarea>
    </div>
    <button class="btn btn-outline-info">Створити замовлення</button>
</form>

<?php 
$content = ob_get_clean();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $place_id = $_GET['id'];
    $user_id = $user['id'];
    $client_address = $_POST['client_address'];
    $be_ready = $_POST['be_ready'];
    $client_phone = $_POST['client_phone'];
    $payment = $_POST['payment'];
    $price = $_POST['price'];
    $info = $_POST['info'];

    $sql = "INSERT INTO orders (place_id, user_id, client_address, be_ready, client_phone, payment, price, info)
    VALUES ('$place_id', '$user_id', '$client_address', '$be_ready', '$client_phone', '$payment','$price', '$info')";

    if (mysqli_query($conn, $sql)) {
        header("Location: /orders/active.php");
    }

}

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';