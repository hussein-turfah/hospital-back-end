<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $hospital_id = $_POST['hospital_id'];
  $user_id = $_POST['user_id'];
  
  if(count(checkPresenceHospital($hospital_id,$user_id)) == 1 ){

    $sql_statement = 'update hospital_users
    set is_active = 1
    where hospital_id = ? and user_id = ?';

    $sql_statement = mysqli_prepare($link,$sql_statement);
    mysqli_stmt_bind_param($sql_statement,'ii',$hospital_id,$user_id);
    
    if(mysqli_stmt_execute($sql_statement)){
      $response['sucess'] = 'Patient sucessfully removed.';
      echo json_encode($response);
    }else{
      $error = 'There was an error removing this patient!';
      $response = ['response' => $error];
      echo json_encode([$error]);
  }}else{
    $error = 'This patient is not available in any hospital!';
    $response = ['response' => $error];
    echo json_encode([$error]);
  };
}




?>