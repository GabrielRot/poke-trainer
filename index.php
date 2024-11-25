<?php
  session_start();
  //require_once 'private/config/db-connection';

  // $login = file_get_contents('public/views/login.html');

  // $login = str_replace('..', 'public', $login);
  // echo $login;

  header('Location: private/models/login.php');
?>