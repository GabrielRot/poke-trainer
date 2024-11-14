<?php
  require('usuarios.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $logon = $_POST['logon'];
    $senha = $_POST['senha'];

    $result = searchUser($logon, $senha);
  }

  if ($result[0]['result'] > 0) {
    $_SESSION['logon'] = $logon;
    $_SESSION['senha'] = $senha;
    $_SESSION['logado'] = 'S';


  } else {
    $_SESSION['logado'] = 'N';

    //header('Location: ../../index.php');
    exit;
  }

?>