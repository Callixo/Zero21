// function validateForm(){
//   const nome = document.getElementById('nome');
//   const nasc = document.getElementById('nasc');
//   const mae = document.getElementById('mae');
//   const cpf = document.getElementById('cpf');
  

//   if (!nome.value || !nasc.value || !mae.value || !cpf.value) {
//     alert('Por favor, preencha todos os campos.');
//     return false; // Impede o envio do formulário
//   }

//   // Outras validações personalizadas podem ser adicionadas aqui

//   return true; // Permite o envio do formulário
// }

const form   = document.getElementById('form');
const campos = document.querySelectorAll('.required');
const spans  = document.querySelectorAll('.span-required');
// const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

// function setError(index){
//   campos[index].style.border = '2px solid #e63636';
//   spans[index].style.display = 'block'
// }

// function removerError(index){
//   campos[index].style.border = '';
//   spans[index].style.display = 'none';
// }

function nameValidate(){
  if (campos[0].ariaValueMax.length < 15)
  {
    console.log('Error')
    // setError(0)
  }
    // document.getElementById("proximo");
    // return false
    
  else {
    console.log("Validado")
  }
}


    const formu = document.getElementById('form');
    const camp0s = document.querySelectorAll('.inputs');
  
    formu.addEventListener('submit', (event) => {
      event.preventDefault();
  
      // Criar arrays para armazenar os valores
      const valores = [];
      camp0s.forEach((campo) => {
        valores.push(campo.value);
      });
  
      console.log('Valores dos campos:', valores);
  
      // Redirecionar para a próxima página
      window.location.href = 'Contatos.html';
    });
