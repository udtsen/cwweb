<?php
setcookie('token', 'a', time() - 3600, '/');
header('Location: ../index.php');