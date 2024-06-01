<?php
  $user = include "core/auth.php";
  $isLoggedIn = $user != null;
  $auth_text = $isLoggedIn ? 'Мій профіль' : 'Увійти';
  $auth_link = $isLoggedIn ? 'profile.php' : 'aut.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Сервіс доставки їжі</title>
  <!-- Підключаємо Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Підключаємо власні стилі -->
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<!-- Навігаційне меню -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Сервіс доставки їжі</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a id="profileLink" class="nav-link" href="pages/<?= $auth_link ?>"><?= $auth_text ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/about.html">Про нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/contact.html">Контакти</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Основна частина з інформацією про сервіс -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h1>Ласкаво просимо до сервісу доставки їжі!</h1>
      <p>Ми пропонуємо швидку та зручну доставку смачної їжі прямо до вашого дверей. Наші кур'єри працюють цілодобово, щоб задовольнити ваші потреби.</p>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrationModal">Спробувати зараз</button>
      <a href="pages/<?= $auth_link ?>" class="btn btn-success"><?= $auth_text ?></a>
    </div>
    <div class="col-md-6">
      <!-- Додайте зображення або інші елементи, якщо потрібно -->
    </div>
  </div>
</div>

<!-- Модальне вікно для вибору типу реєстрації -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrationModalLabel">Виберіть тип реєстрації</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Як ви бажаєте зареєструватись?</p>
        <a href="pages/courier_register.html" class="btn btn-primary">Як кур'єр</a>
        <a href="pages/place_register.html" class="btn btn-success">Як заклад</a>
      </div>
    </div>
  </div>
</div>

<!-- Посилання на інструкцію -->
<div class="container mt-3 mb-3">
  <a href="documents/help.pdf" download class="text-decoration-none text-muted">
    <span class="mr-2">Інструкція.pdf</span>
    <span class="material-icons align-middle">description</span>
  </a>
</div>

<!-- Футер -->
<footer class="footer mt-5 py-3 bg-dark text-white">
  <div class="container">
    <span>Сервіс доставки їжі &copy; 2024</span>
  </div>
</footer>

<!-- Підключаємо Bootstrap JS та jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>