<?php
  ob_start();
  $user = include "core/auth.php";
  $isLoggedIn = $user != null;
  $auth_text = $isLoggedIn ? 'Мій профіль' : 'Увійти';
  $auth_link = $isLoggedIn ? 'profile.php' : 'aut.html';
?>

<!-- Основна частина з інформацією про сервіс -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <h1>Ласкаво просимо до сервісу доставки їжі!</h1>
      <p>Ми пропонуємо швидку та зручну доставку смачної їжі прямо до вашого дверей. Наші кур'єри працюють цілодобово, щоб задовольнити ваші потреби.</p>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrationModal">Спробувати зараз</button>
      <a href="pages/<?= $auth_link ?>" class="btn btn-success"><?= $auth_text ?></a>
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

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';