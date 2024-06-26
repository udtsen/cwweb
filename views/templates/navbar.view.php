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
          <a id="profileLink" class="nav-link" href="<?= $auth_link ?>"><?= $auth_text ?></a>
        </li>
        <?php if($user): ?>
          <li class="nav-item">
          <a id="profileLink" class="nav-link" href="/orders/active.php">Активні замовлення</a>
          </li>
          <li class="nav-item">
          <a id="profileLink" class="nav-link" href="/profile/logout.php">Вийти</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="/pages/about.php">Про нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/contact.php">Контакти</a>
        </li>
      </ul>
    </div>
  </div>
</nav>