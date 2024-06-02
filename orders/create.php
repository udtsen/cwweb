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
        <textarea name="info" class="form-control" id="info" rows="3" placeholder="Додаткова інформація(необов'язково)"></textarea>
    </div>
    <button class="btn btn-outline-info">Створити заклад</button>
</form>

<?php 
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';