<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $user_id = $_POST['user_id'];
  $hospital_id = $_POST['hospital_id'];

  $check_presence = 'SELECT is_active 
  from hospital_users
  where user_id = ?
  and is_active = 1';

  $check_presence = mysqli_prepare($link,$check_presence);
  mysqli_stmt_bind_param($check_presence,'i',$user_id);

  mysqli_stmt_execute($check_presence);
  $presence_result = mysqli_stmt_get_result($check_presence);
  $presence_data = mysqli_fetch_all($presence_result);

  //this if statement checks if the patient is not present in any hospital.
  if(count($presence_data)==0){
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