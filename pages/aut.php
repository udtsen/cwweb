<?php

$conn = include "../core/dbconnect.php";

// Перевірка з'єднання
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Отримання даних з форми
$email = $_POST['email'];
$password = $_POST['password'];

// SQL-запит на перевірку авторизації
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

$response = array();

// Перевірка, чи знайдено користувача в таблиці кур'єрів
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $response['success'] = true;
        $response['user_type'] = $row['status']; // Вказуємо тип користувача
    } else {
        $response['success'] = false;
        $response['error'] = "Неправильний пароль.";
    }
}
else {
    $response['success'] = false;
    $response['error'] = "Користувача з таким email не знайдено.";
}

// Закриття з'єднання
mysqli_close($conn);

// Виведення JSON-відповіді
header('Content-Type: application/json');
echo json_encode($response);
?>
