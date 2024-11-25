<?php
  //session_start();

  header("Content-Type: application/json");

  include "../classes/Pokemons.php";
  
  $pokemons = new Pokemons();

  $body = file_get_contents("php://input");

  $data = json_decode($body, true);

  if (is_array($data)) {
    try {
      $array = $data['pokemon'][0];
      $pokemons -> catch($_SESSION['id_usuario'], $array['pokemonName'], $array['id'], $array['url'], $array['img'], $array['icon'], $array['level']);

      $response = [
        "success"  => true,
        "message"  => "Pokemon enviado com sucesso!",
        "received" => $array['pokemonName']
      ];
    } catch (Exception $error) {
      $response = [
        "success" => false,
        "message" => $error -> getMessage(),
      ];
    }
  } else {
    $response = [
      "success" => false,
      "error"   => "Os dados enviados não são válidos ou o campo 'pokemons' está ausente" 
    ];
  }

  echo json_encode($response);
  exit;
?> 