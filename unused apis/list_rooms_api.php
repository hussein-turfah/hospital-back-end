<?php

include('credentials_db.php');


$department_id = $_POST['department_id'];

$sql_statement = "select id,room_number,number_beds
from rooms where department_id = ?";
$sql_statement = mysqli_prepare($link,$sql_statement);
mysqli_stmt_bind_param($sql_statement, 'i', $department_id);
mysqli_stmt_execute($sql_statement);

$sql_result = mysqli_stmt_get_result($sql_statement);
$rooms_data = mysqli_fetch_all($sql_result);

echo json_encode($rooms_data);

?>