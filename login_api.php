<?php

include('credentials_db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;    
  }

  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  #question about the error faced.
  $sql_statement = "select * from users where email = '$email'";
  $result = mysqli_query($link,$sql_statement);
  $response = [];

  // echo json_encode(mysqli_num_rows($result));

  if(mysqli_num_rows($result) === 1 ){
    $row = mysqli_fetch_assoc($result);
    $password = hash('sha256',$password . $row['salt']);

    // echo $password;
    // echo '-'.$row['password'];
    // echo '-'.$row['salt']
    if ($email === $row['email'] && $password === $row['password']){
      $response['user_id'] = $row['id'];
      echo json_encode($response);
    }else{
      echo json_encode('Please check your email and password!');
    }

  }

}




?>