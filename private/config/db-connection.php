<?php
  session_start();
    $host     = 'localhost';
    $dbname   = 'db_poketrainer';
    $username = 'root';
    $password = '';

    global $dbh;
  
    try {
      $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      return $dbh;
    } catch (PDOException $e) {
      echo "Erro de conexão: " . $e->getMessage();
      exit;
    }
?>