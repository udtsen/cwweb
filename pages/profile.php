<?php
	include "../core/auth.php";
	if ($user['status'] == 'courier') {
		header("Location: /orders/active.php");
	} elseif ($user['status'] == 'place') {
		header("Location: profile/place.php");
	} else {
		die();
	}