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
$email = $_POST['email'];
$password = $_POST['password'];

// SQL-запит на перевірку авторизації
$sql_courier = "SELECT * FROM couriers WHERE email = '$email'";
$sql_institution = "SELECT * FROM places WHERE email = '$email'";

$result_courier = mysqli_query($conn, $sql_courier);
$result_institution = mysqli_query($conn, $sql_institution);

$response = array();

// Перевірка, чи знайдено користувача в таблиці кур'єрів
if (mysqli_num_rows($result_courier) > 0) {
    $row = mysqli_fetch_assoc($result_courier);
    if (password_verify($password, $row['password'])) {
        $response['success'] = true;
        $response['user_type'] = 'courier'; // Вказуємо тип користувача
    } else {
        $response['success'] = false;
        $response['error'] = "Неправильний пароль.";
    }
} 
// Перевірка, чи знайдено користувача в таблиці закладів
elseif (mysqli_num_rows($result_institution) > 0) {
    $row = mysqli_fetch_assoc($result_institution);
    if (password_verify($password, $row['password'])) {
        $response['success'] = true;
        $response['user_type'] = 'places'; // Вказуємо тип користувача
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
