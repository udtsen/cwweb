<?php 
ob_start();

$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';
?>

<form method="post">
    <div class="form-group">
        <label for="name">Назва закладу:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Вкажіть назву">
    </div>
    <div class="form-group">
        <label for="address">Адреса закладу:</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Вкажіть адресу">
    </div>
    <div class="form-group">
        <textarea name="info" class="form-control" id="info" rows="3" placeholder="Додаткова інформація(необов'язково)"></textarea>
    </div>
    <button class="btn btn-outline-info">Створити заклад</button>
</form>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    $conn = include "../core/dbconnect.php";
    
    $user_id = $user['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $info = $_POST['info'];

    $sql = "INSERT INTO places (user_id, name, address, info)
    VALUES ('$user_id', '$name', '$address', '$info')";

    if (mysqli_query($conn, $sql)) {
        header("Location: /pages/profile/place.php");
    }
}

$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';