<?php
  include '../config/db-connection.php';

    function searchUser($logon, $senha) {
      $dbh = getConnection();

      $sql = "select count(1) as result
                from usuario usuario
              where usuario.logon = :logon
                and usuario.senha = :senha";

      $statement = $dbh -> prepare($sql);

      $statement -> bindParam(':logon', $logon);
      $statement -> bindParam(':senha', $senha);

      if($statement -> execute()) {
        return $statement -> fetchAll(PDO::FETCH_ASSOC);
      };  
  }
   // return $statement -> fetchAll(PDO::FETCH_ASSOC);
 // }
?>