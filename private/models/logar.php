<?php
  session_start();
  if (isset($_POST['logon']) && !empty($_POST['logon']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    require '../config/db-connection.php';
    require '../classes/Usuario.php';

    $usuario = new Usuario();
    
    $logon = addslashes($_POST['logon']);
    $senha = addslashes($_POST['senha']);
    
    if ($usuario -> login($logon, $senha)) {
      if (isset($_SESSION['id_usuario']) && isset($_SESSION['logon'])) {
        header('Location: menu.php');
      } else {
        header('Location: login.php');
      }
    } else {
      header('Location: login.php');
    }

  } else {
    header('Location: login.php');
  }

?>