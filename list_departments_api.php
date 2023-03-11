<?php

include('credentials_db.php');



$sql_statement = 'select id,name
from departments';

$sql_result = mysqli_query($link,$sql_statement);
$departments_data = mysqli_fetch_all($sql_result);

echo json_encode($departments_data);

?>