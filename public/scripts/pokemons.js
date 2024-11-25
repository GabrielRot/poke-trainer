const pokemonImg = document.getElementById("pokemon-img");
let buttonCatch  = document.getElementById('catch-pokemon');
let pokemonData;

let tentativas    = document.getElementById('tentativas');
let qtdTentativas = tentativas.innerText.match(/\d+/); 

let gifPlate    = document.getElementById('gif-plate');
let staticPlate = document.getElementById('static-plate');

let pokemonName  = document.getElementById('pokemon-name');
let pokemonLevel = document.getElementById('pokemon-level');
let pokemonLvl;

async function fetchPokemon(pokemonId) {
  try {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonId}`);
    const data     = await response.json();

    const imageUrl =  data['sprites']['versions']['generation-v']['black-white']['animated']['front_default'];//data.sprites.other["official-artwork"].front_default;

    if (imageUrl) {
      pokemonImg.src = imageUrl;
      pokemonImg.alt = data.name;

    }

    console.log(data);

    pokemonLvl = (Math.floor(Math.random() * 100) +1);
    pokemonName.innerText  = data.name.charAt(0).toUpperCase() + data.name.slice(1);
    pokemonLevel.innerText = `Lv${ pokemonLvl }`;

    pokemonData = data;
  } catch (error) {
    console.error("Erro ao buscar o pokemon:", error);
  }
}

async function chamarCallback(pData, pLevel) {
  const pokemon = [
    {
      pokemonName: pData.name,
      id: pData.id,      
      url: pData.forms[0].url,
      img: pokemonImg.src,
      icon: pData['sprites']['versions']['generation-viii']['icons']['front_default'],
      level: pLevel,
    }
  ]

  fetch("catch-pokemon.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ pokemon })
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na requisição");
      }
      
      return response.json(fetchPokemon(Math.floor(Math.random() * 500) +1));
    })
    .then((data) => {
      if (data.success) {
        console.log(data.message);
        console.log("Pokemons recebidos pelo servidor:", data.received);

        fetchPokemon()

        qtdTentativas = tentativas.innerText.match(/\d+/);

        if (qtdTentativas > 0) {
          tentativas.innerText = qtdTentativas-1 + ' Tentativas'; 
          qtdTentativas = tentativas.innerText.match(/\d+/);
        }

        showToast("Pokemon capturado com sucesso", "success");
      } else {
        console.log("Erro:", data.error);
        showToast(`Erro: ${ data.error }`, "error");
      }
    })
    .catch((error) => {
      console.error("Erro na requisição:", error);
      showToast(`Erro: ${ error }`, "error");
    });
}

fetchPokemon(Math.floor(Math.random() * 500) +1);

buttonCatch.addEventListener('click', function() {
  if (qtdTentativas > 0) {
    chamarCallback(pokemonData, pokemonLvl);

  } else {
    showToast("Limite de captura excedido. Espere 24H para tentar novamente", "error");

  }
});

setTimeout(function() {
  gifPlate.classList.add('hidden');
  staticPlate.classList.remove('hidden');
}, 1120 );