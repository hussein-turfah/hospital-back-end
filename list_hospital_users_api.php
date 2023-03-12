<?php
include('credentials_db.php');

if ($_SERVER['REQUEST_METHOD'] =='GET'){
 $sql_statement1 = "select h.id,h.name as hospital_name,
  user_id,u.name as user_name,
  is_active

  from hospital_users as h_u
  inner join hospitals as h on h_u.hospital_id = h.id
  inner join users as u on h_u.user_id = u.id ";


  $sql_result = mysqli_query($link,$sql_statement1);
  $hospital_users = mysqli_fetch_all($sql_result, MYSQLI_ASSOC);

  echo json_encode($hospital_users);
}

?>