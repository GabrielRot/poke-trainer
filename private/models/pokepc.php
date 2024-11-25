<?php
  include '../classes/Pokemons.php';

  $pokemons      = new Pokemons();
  $dadosPokemons = '';

  $pagina = file_get_contents('../../public/views/pokepc.html');

  $dados = $pokemons -> getAllPokemons($_SESSION['id_usuario']); 
  
  foreach ($dados as $pokemon): 
    $dadosPokemons = $dadosPokemons . '<div>
                                        <img src="' . $pokemon['pokemon_icon'] . '">' .
                                        // '<span class="poke-name">' . $pokemon['desc_pokemon'] . '</span>' .
                                        // '<span class="poke-level">Lv.' . $pokemon['level_pokemon'] . '</span>' .
                                      '</div>';
  endforeach;

  $pagina = str_replace('../', '../../public/', $pagina);
  $pagina = str_replace('#pokemons#', $dadosPokemons, $pagina);

  echo $pagina;
?>