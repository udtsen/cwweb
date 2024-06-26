<?php

include "../helpers/generateRandomString.php";

// Підключення до бази даних
$conn = include "../core/dbconnect.php";

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
$sql = "INSERT INTO users (email, password, status) VALUES ('$email', '$hashed_password', 'place')";

$response = array();

if (mysqli_query($conn, $sql)) {
    $id = mysqli_insert_id($conn);
    $time = time() + (3600 * 24 * 365); // year
    $token = generateRandomString(256);
    
    $sql = "INSERT INTO sessions (id_user, token) VALUES ('$id', '$token')";
    if (mysqli_query($conn, $sql)){
        setcookie('token', $token, $time, '/');
        // Перенаправлення на іншу сторінку після успішного додавання користувача до бази даних
        header("Location: aut.html?registration=success");
        exit();
    }
} else {
    $response['success'] = false;
    $response['error'] = "Помилка: " . $sql . "<br>" . mysqli_error($conn);
}

// Закриття з'єднання
mysqli_close($conn);
?>