<?php
  require('usuarios.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $logon = $_POST['logon'];
    $senha = $_POST['senha'];

    $result = searchUser($logon, $senha);
  }

  echo json_encode($resultado);
?>