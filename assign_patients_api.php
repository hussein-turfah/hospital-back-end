<?php
include('credentials_db.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $hospital_id = $_POST['hospital_id'];
  $user_id = $_POST['user_id'];

  //this if statement checks if the patient is not present in any hospital before adding him.
  if(count(check_presence($user_id))==0){
    $sql_statement = "insert into 
    hospital_users(hospital_id,user_id,is_active) values(?,?,1)";
    
    $sql_statement = mysqli_prepare($link,$sql_statement);
    mysqli_stmt_bind_param($sql_statement, 'ii',$hospital_id,$user_id);
    if(mysqli_stmt_execute($sql_statement)){

      $response['sucess'] = 'Patient sucessfully assigned.';
      echo json_encode($response);
    }else{
      $error = 'There was an error assigning this patient!';
      $response = ['response' => $error];
      echo json_encode([$error]);
    }
  }else{
    $error = 'This patient is already in a hospital!';
    $response = ['response' => $error];
    echo json_encode([$error]);
  };
}





?>