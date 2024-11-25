<?php
  include '../config/db-connection.php';

  class Pokemons {

    public function catch($idUsuario, $pokemonName, $idPokemon, $pokemonUrl, $pokemonImg, $pokemonIcon, $levelPokemon) {
      global $dbh;

      $sql = "insert into pokemons( id_pokemon
                                  , id_usuario
                                  , desc_pokemon
                                  , pokemon_url
                                  , pokemon_sprite
                                  , pokemon_icon
                                  , level_pokemon
                                  )
                            values( :id_pokemon
                                  , :id_usuario
                                  , :desc_pokemon
                                  , :pokemon_url
                                  , :pokemon_sprite
                                  , :pokemon_icon
                                  , :level_pokemon
                                  )";

      $statement = $dbh -> prepare($sql);

      $statement -> bindParam(':id_pokemon', $idPokemon);
      $statement -> bindParam(':id_usuario', $idUsuario);
      $statement -> bindparam(':desc_pokemon', $pokemonName);
      $statement -> bindParam(':pokemon_url', $pokemonUrl);
      $statement -> bindParam(':pokemon_sprite', $pokemonImg);
      $statement -> bindParam(':pokemon_icon', $pokemonIcon);
      $statement -> bindparam(':level_pokemon', $levelPokemon);

      $statement -> execute();

      $sql = "select tent_captura.qtd_tentativas
                from tent_captura tent_captura
               where id_usuario = :id_usuario";

      $statement = $dbh -> prepare($sql);

      $statement -> bindParam(':id_usuario', $idUsuario);

      $statement -> execute();

      if ($statement -> rowCount() > 0) {
        $dado = $statement -> fetch();

        if ($dado['qtd_tentativas'] > 0) {
          $sql = "update tent_captura
                    set qtd_tentativas = qtd_tentativas-1
                  where id_usuario     = :id_usuario";

          $statement = $dbh -> prepare($sql);

          $statement -> bindParam(':id_usuario', $idUsuario);

          $statement -> execute();
        }
      }
    }

    public function getTentativas($idUsuario) {
      global $dbh;

      $sql = "select tent_captura.id_tentativa
                   , tent_captura.id_usuario
                   , tent_captura.qtd_tentativas
                   , tent_captura.data_tentativa
                from tent_captura tent_captura
               where id_usuario = :id_usuario";

      $statement = $dbh -> prepare($sql);

      $statement -> bindParam(':id_usuario', $idUsuario);

      $statement -> execute();

      $dado = $statement -> fetch();

      if ((date('d/m/Y') == $dado['data_tentativa']) == 1) {
        $sql = "update tent_captura
                   set qtd_tentativas = 3
                 where id_usuario   = :id_usuario
                   and id_tentativa = :id_tentativa";

        $statement = $dbh -> prepare($sql);

        $statement -> bindParam(':id_usuario', $idUsuario);
        $statement -> bindParam(':id_tentativa', $dado['id_tentativa']);

        $statement -> execute();

        $sql = "select tent_captura.id_tentativa
                     , tent_captura.id_usuario
                     , tent_captura.qtd_tentativas
                     , tent_captura.data_tentativa
                  from tent_captura tent_captura
                 where id_usuario = :id_usuario";

        $statement = $dbh -> prepare($sql);

        $statement -> bindParam(':id_usuario', $idUsuario);

        $statement -> execute();

        $dado = $statement -> fetch();

        return $dado['qtd_tentativas'];
      }
      
      return $dado['qtd_tentativas'];
    }

    public function getAllPokemons($idUsuario) {
      global $dbh;

      $sql = "select pokemons.seq_pokemon
                   , pokemons.id_pokemon
                   , pokemons.id_usuario
                   , pokemons.desc_pokemon
                   , pokemons.pokemon_url 
                   , pokemons.pokemon_sprite
                   , pokemons.pokemon_icon
                   , pokemons.level_pokemon
                from pokemons pokemons
               where pokemons.id_usuario = :id_usuario";

      $statement = $dbh -> prepare($sql);

      $statement -> bindParam(':id_usuario', $idUsuario);

      $statement -> execute();

      $dados = $statement -> fetchAll(PDO::FETCH_ASSOC);

      return $dados;
    }
  }
?>