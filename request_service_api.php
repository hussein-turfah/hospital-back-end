<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){
  

  $user_id = $_POST['user_id'];
  $description = $_POST['description'];
  $status = 'pending';
  $department_id = $_POST['department_id'];

  $sql_statement = "INSERT into
  services(user_id,description,status,department_id)
  values (?,?,?,?)";

  $sql_statement = mysqli_prepare($link,$sql_statement);
  mysqli_stmt_bind_param($sql_statement, 'issi',$user_id,$description,$status,$department_id);
  mysqli_stmt_execute($sql_statement);


}



?>