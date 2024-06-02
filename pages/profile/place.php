<?php 
ob_start();
$user = include $_SERVER['DOCUMENT_ROOT'] . '/core/auth.php';

$conn = include "../../core/dbconnect.php";
$id = $user['id'];
$sql = "SELECT * FROM places WHERE user_id = '$id'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $places[] = $row;
}

?>

<h2>Вітаємо</h2>
<h3>Список ваших закладів:</h3>

<table class="table">
	<?php foreach ($places as $place): ?>
	<tr>
		<th><?= $place['name'] ?></th>
		<td><?= $place['address'] ?></td>
		<td><a href="/orders/create.php?id=<?=$place['id']?>">Створити замовлення</a></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="3"><a href="/places/create.php">Додати заклад</td>
	</tr>
</table>

<?php 
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/views/templates/base.view.php';