<?php
  //require_once 'private/config/db-connection';
  session_start();

  $login = file_get_contents('public/views/login.html');

  if (isset($_POST['login'])) {
    if ($_POST['logon'] == '' || $_POST['senha'] == '' ) {
      print_r('caralhohso'  ;
      str_replace('style="display: none;"', '', $login);
      str_replace('#mensagem#', 'Logon ou Senha não informado.', $login);
    } else {
      $logon = strip_tags(trim($_POST['logon']));
      $senha = strip_tags(trim($_POST['senha']));

      require('usuarios.php');

      searchUser($logon, $senha);
    }
  }


  $login = str_replace('..', 'public', $login);
  echo $login;
?>