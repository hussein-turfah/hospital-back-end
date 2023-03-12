<?php

include('functions.php');
if ($_SERVER['REQUEST_METHOD'] =='GET'){
  $table_name = $_POST['table_name'];
  echo listData($table_name);
}

?>