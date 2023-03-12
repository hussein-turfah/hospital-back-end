<?php
include('credentials_db.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $hospital_id = $_POST['hospital_id'];
  $user_id = $_POST['user_id'];
  

  //this if statement checks the times this patient is present,
  //if he was present at least one time, it will remove him
  //from the hospital chosen(by its id)
  if(count(check_presence($user_id))>0){
    $sql_statement = 'update hospital_users
    set is_active = 0
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
    };
  }else{
    $error = 'This patient is not available in this hospital!';
    $response = ['response' => $error];
    echo json_encode([$error]);;
  };

  

}




?>