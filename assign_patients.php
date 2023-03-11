<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $user_id = $_POST['user_id'];
  $hospital_id = $_POST['hospital_id'];

  $sql_statement = "insert into hospital_users(hospital_id,user_id) values(?,?)";
  $sql_statement = mysqli_prepare($link,$sql_statement);
  mysqli_stmt_bind_param($sql_statement, 'ii',$hospital_id,$user_id);
  if(mysqli_stmt_execute($sql_statement)){
    $response['sucess'] = 'Patient sucessfully assigned';
    echo json_encode($response);
  }else{
    $error = 'There was an error assigning this patient';
    $response = ['response' => $error];
    echo json_encode([$error]);
  }

}





?>