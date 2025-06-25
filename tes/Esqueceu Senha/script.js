// document.getElementById("recoveryForm").addEventListener("submit", function(event) {
//     var email = document.getElementsByName("email")[0].value;
//     var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

//     if (!emailRegex.test(email)) {
//         alert("Por favor, insira um endereço de e-mail válido.");
//         event.preventDefault();
//     }
// });





// document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
//     event.preventDefault(); // Evita o envio padrão do formulário

//     // Obter o valor do e-mail inserido pelo usuário
//     const email = document.getElementById('email').value;

//     // Aqui você iria adicionar a lógica para enviar um e-mail com um link seguro para alteração da senha
//     // Por exemplo, você poderia fazer uma requisição AJAX para um servidor backend que cuida do envio de e-mails
//     // Aqui vamos apenas exibir uma mensagem simples

//     const messageElement = document.getElementById('message');

//     // Simulação de envio bem-sucedido
//     messageElement.textContent = `Um e-mail foi enviado para ${email} com instruções para alterar sua senha.`;
//     messageElement.style.color = 'green';
// });
