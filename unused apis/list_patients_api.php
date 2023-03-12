<?php

include('credentials_db.php');

$sql_statement = 'select id,name from users where usertype_id = 3';

$sql_result = mysqli_query($link,$sql_statement);
$patients_data = mysqli_fetch_all($sql_result);

echo json_encode($patients_data);

?>