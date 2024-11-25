<?php
  include '../config/db-connection.php';
   // return $statement -> fetchAll(PDO::FETCH_ASSOC);
 // }

  class Usuario {
    
    public function login($logon, $senha) {
      global $dbh;
      
      $sql = "select usuario.id_usuario 
                   , usuario.logon 
                   , usuario.senha 
                   , usuario.nome 
                   , usuario.nascimento 
                from usuario usuario
               where usuario.logon = :logon
                 and usuario.senha = :senha";      

      $statement = $dbh -> prepare($sql);

      $statement -> bindParam(':logon', $logon);
      $statement -> bindParam(':senha', $senha);

      $statement -> execute();

      if ($statement -> rowCount() > 0) {
        $dado = $statement -> fetch();

        $_SESSION['id_usuario'] = $dado['id_usuario'];
        $_SESSION['logon']      = $dado['logon'];

        return true;
      } else {
        return false;
      }

    } 

  }
?>