<?php

#DO NOT FORGET TO ADD THE USERTYPE CHOSEN INSTEAD OF USERTYPE GIVEN FOR TEST ON LINE 21!!!!!

session_start();
include('credentials_db.php');

#initializing variables
$email_error = "";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    exit;
}
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$salt = generateRandomString(4);
$hashed_password = hash('sha256',$password.$salt);
$birth = $_POST['dob'];
$gender = $_POST['gender'];
$user_type = 3;



//checking if the email is already registered in the database or not.
$sql_statement = mysqli_prepare($link,'select email from users where email = ?');
mysqli_stmt_bind_param($sql_statement, 's', $email);
mysqli_stmt_execute($sql_statement);
mysqli_stmt_store_result($sql_statement);

// checking the number of rows where the email is registered.
if (mysqli_stmt_num_rows($sql_statement)>0){
    $error = 'Email already exists';
    $response = ['response'=> $error];
    echo json_encode($error);
}else{
    $sql_statement2 = 'insert into users 
    (name, email, password,salt, gender, dob,usertype_id) 
    values(?,?,?,?,?,?,?)';
    
    if($sql_statement = mysqli_prepare($link,$sql_statement2)){
        mysqli_stmt_bind_param($sql_statement, 'ssssssi',$name,$email,$hashed_password,$salt,$gender,$birth,$user_type);
        if(mysqli_stmt_execute($sql_statement)){
            $success = 'success';
            $response['status'] = 'sucess';
            echo json_encode($response);
        }else{
            $error = 'sql excute error';
            $response = ['response' => $error];
            echo json_encode([$error]);
        }
    }else{
        $error = 'preparation error';
        $response = ['response'=> $error];
        echo json_encode([$error]);
    }
}




//this function returns a random string that will be used later as the salt.
function generateRandomString($length = 10){
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $characters_length = strlen($characters);
    $random_string = "";
    for($i = 0; $i < $length; $i++){
        $random_string .= $characters[rand(0,$characters_length-1)];
    }
    return $random_string;
}




?>