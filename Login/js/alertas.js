// Função para buscar dados do PHP
function fetchDados() {
    // Realiza a requisição ao arquivo PHP
    fetch('php/models/usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'email=' + encodeURIComponent(document.getElementById('email').value) + 
              '&pass=' + encodeURIComponent(document.getElementById('senha').value)
    })
    .then(response => response.json())  // Converte a resposta em JSON
    .then(dados => {
        // Verifica a resposta e exibe no HTML
      alert('Mensagem: ' + dados.mensagem + '<br>Email: ' + dados.email)

        // Se o login for bem-sucedido, redireciona para a página principal
        if (dados.status === 'success') {
            window.location.href = 'Página Principal/index.html';
        }
    })
    .catch(error => {
        console.error('Erro ao buscar dados:', error);
    });
}

fetchDados();
