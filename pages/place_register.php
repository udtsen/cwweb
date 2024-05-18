<?php
// Підключення до бази даних
$servername = "localhost";
$username = "root"; // Ваш логін до MySQL
$password = ""; // Ваш пароль до MySQL
$dbname = "delivery"; // Назва вашої бази даних

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Перевірка з'єднання
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Отримання даних з форми
$email = $_POST['placeEmail'];
$password = $_POST['loginPassword'];

// Хешування паролю
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL-запит на вставку даних
$sql = "INSERT INTO places (email, password) VALUES ('$email', '$hashed_password')";

$response = array();

if (mysqli_query($conn, $sql)) {
    // Перенаправлення на іншу сторінку після успішного додавання користувача до бази даних
    header("Location: aut.html?registration=success");
    exit();
} else {
    $response['success'] = false;
    $response['error'] = "Помилка: " . $sql . "<br>" . mysqli_error($conn);
}

// Закриття з'єднання
mysqli_close($conn);
?>