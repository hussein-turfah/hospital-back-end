<?php

include('credentials_db.php');

$sql_statement = 'select id from users where usertype_id = 3';

$sql_result = mysqli_query($link,$sql_statement);
$patient_ids = mysqli_fetch_all($sql_result);

echo json_encode($patient_ids);

?>