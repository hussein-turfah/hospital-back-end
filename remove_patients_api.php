<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='POST'){

  $hospital_id = $_POST['hospital_id'];
  $user_id = $_POST['user_id'];
  
  //check if the patient is available in this 
  //hospital or in any other hospital before removing him.
  $check_presence = 'SELECT is_active 
  from hospital_users
  where user_id = ?
  and is_active = 1';

  $check_presence = mysqli_prepare($link,$check_presence);
  mysqli_stmt_bind_param($check_presence,'i',$user_id);

  mysqli_stmt_execute($check_presence);
  $presence_result = mysqli_stmt_get_result($check_presence);
  $presence_data = mysqli_fetch_all($presence_result);

  //this if statement checks the times this patient is present,
  //if he was present at least one time, it will remove him
  //from the hospital chosen(by its id)
  if(count($presence_data)>0){
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