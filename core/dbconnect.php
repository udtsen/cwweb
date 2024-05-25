<?php

$settings = include "dbsettings.php";

try{
    $conn = mysqli_connect($settings['servername'], $settings['username'], $settings['password'], $settings['dbname']);
}catch(Exception $e){
    return false;
}

return $conn;