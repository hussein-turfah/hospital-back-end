<?php

include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $user_id = $_POST['user_id'];
  $medication_id = $_POST['medication_id'];
  $quantity = $_POST['quantity'];

  $sql_statement = "INSERT users_has_medications(user_id, medication_id, quantity)
  values(?,?,?)";
  

  $sql_statement = mysqli_prepare($link,$sql_statement);
  mysqli_stmt_bind_param($sql_statement, 'iii',$user_id,$medication_id,$quantity);
  mysqli_stmt_execute($sql_statement);
  
}



?>