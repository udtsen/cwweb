<?php
// Підключення до бази даних
$conn = include "../core/dbconnect.php";

// Перевірка з'єднання
if (!$conn) {
    $response['success'] = false;
    $response['error'] = "Connection failed: " . mysqli_connect_error();
    echo json_encode($response);
    exit();
}

// Отримання даних з форми
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$transportType = $_POST['transportType'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$plainPassword = $_POST['confirmPassword']; // Змінна для зберігання незахешованого паролю

// Захешуємо пароль
$password = password_hash($plainPassword, PASSWORD_DEFAULT);

// SQL-запит на вставку даних
$sql = "INSERT INTO users (last_name, first_name, transport_type, phone, email, password, status)
VALUES ('$lastName', '$firstName', '$transportType', '$phone', '$email', '$password', 'courier')";

$response = array();

if (mysqli_query($conn, $sql)) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Помилка: " . $sql . "<br>" . mysqli_error($conn);
}

// Закриття з'єднання
mysqli_close($conn);

// Виведення JSON-відповіді
header('Content-Type: application/json');
echo json_encode($response);
?>
