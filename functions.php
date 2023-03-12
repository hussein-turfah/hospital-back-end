<?php
include('credentials_db.php');

//check if the patient is available in this hospital or in any other hospital before adding or removing him.
  function check_presence($user_id){
    include('credentials_db.php');
    
    $check_presence = 'SELECT is_active 
    from hospital_users
    where user_id = ?
    and is_active = 1';

    $check_presence = mysqli_prepare($link,$check_presence);
    mysqli_stmt_bind_param($check_presence,'i',$user_id);

    mysqli_stmt_execute($check_presence);
    $presence_result = mysqli_stmt_get_result($check_presence);
    $presence_data = mysqli_fetch_all($presence_result);
    return $presence_data;
    }
?>