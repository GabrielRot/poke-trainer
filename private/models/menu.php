<?php  
  session_start();

  if (isset($_SESSION['id_usuario']) && isset($_SESSION['logon'])) {
    $main = file_get_contents('../../public/views/index.html');

      $main = str_replace('../', '../../public/', $main);
      $main = str_replace('about.html', 'about.php', $main);
      $main = str_replace('pokemons.html', 'pokemons.php', $main);
      $main = str_replace('pokepc.html', 'pokepc.php', $main);

    echo $main;
  } else {
    header('Location: login.php');
  }
?>