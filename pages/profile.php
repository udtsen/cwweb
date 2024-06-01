<?php
	include "../core/auth.php";
	if ($user['status'] = 'courier') {
		header("Location: profile/courier.php");
	} elseif ($user['status'] = 'place') {
		var_dump($user['status']);
		die();
		header("Location: profile/place.php");
	} else {
		die();
	}