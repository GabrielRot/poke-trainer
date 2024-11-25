<?php
  session_start();

  if (isset($_SESSION['id_logon'])) {
    header('Location: menu.php');
  } else {
    $login = file_get_contents('../../public/views/login.html');
  
    $login = str_replace('../', '../../public/', $login);
  
    echo $login;
  }
?>