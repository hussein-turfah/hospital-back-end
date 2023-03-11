<?php

include('credentials_db.php');

$sql_statement = 'select id,name from hospitals';

$sql_result = mysqli_query($link,$sql_statement);
$hospitals_data = mysqli_fetch_all($sql_result);

echo json_encode($hospitals_data);

?>