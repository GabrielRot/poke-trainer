document.getElementById('form').addEventListener('submit', function(event) {
  event.preventDefault();

  const logon = document.getElementById('input-logon');
  const senha = document.getElementById('input-senha');

  fetch('/private/models/processa-formulario.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `logon=${logon}&senha=${senha}`
  })
  .then(response => response.json())
  .then(data => {
    const resultadosDiv = document.getElementById('resultados');
    resultadosDiv.innerHTML = '';

    if (data.length > 0) {
      data.forEach(row => {
        resultadosDiv.innerHTML +- `<p>Resultados: ${row['logon']}</p>`;
      });
    } else {
      resultadosDiv.innerHTML = '<p>Nenhum resultado encontrado.</p>';
    }
  })
  .catch(error => {
    console.error('Erro:', error);
  })
});