<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){
  

  $user_id = $_POST['user_id'];
  $service_id = $_POST['service_id'];
  $status = $_POST['status'];

  $sql_statement = "UPDATE services 
  set status = ?
  where id = $service_id
  and user_id = $user_id";

  $sql_statement = mysqli_prepare($link,$sql_statement);
  mysqli_stmt_bind_param($sql_statement, 's',$status);
  mysqli_stmt_execute($sql_statement);

}



?>