<?php
  require_once '../config/db-connection.php';

  function searchUser($logon, $senha) {
    global $dbh;


    $sql = "select count(1)
              from usuario usuario
             where usuario.logon = :logon
               and usuario.senha = :senha";

    $statement = $dbh -> prepare($sql);

    $statement -> bindParam(':logon', $logon);
    $statement -> bindParam(':senha', $senha);

    $statement -> execute();

    return $statement -> fetchAll(PDO::FETCH_ASSOC);
  }
?>