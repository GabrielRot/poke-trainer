<?php
  //session_start();

  include '../classes/Pokemons.php';

  $pokemons = new Pokemons();
  
  $pagina = file_get_contents("../../public/views/pokemons.html");
  $pagina = str_replace("../", "../../public/", $pagina);

  $tentativas = $pokemons -> getTentativas($_SESSION['id_usuario']) . ' Tentativas';

  $pagina = str_replace("#Tentativas#", $tentativas, $pagina);  

  echo $pagina;
?>