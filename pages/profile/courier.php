<?php ob_start() ?>

<h2>Вітаємо, шановний кур'єр</h2>
<h3>Активні замовлення:</h3>

<?php
header("Location: /orders/active.php");
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';