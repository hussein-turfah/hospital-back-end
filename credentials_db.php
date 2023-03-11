<?php
$host_name = 'localhost';
$database = 'hospital_db';
$username = 'root';
$password = '';

#echo 'database loaded successfully';

$link = new mysqli($host_name, $username, $password, $database);

header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers:*");

if ($link->connect_error) {
    die('<p>Failed to connect to MySQL: ' . $link->connect_error . '</p>');
}

?>