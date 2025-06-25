let formData = [];

function enviar() {
  let isValid = true;
  campos.forEach((campo, index) => {
    if (!campo.checkValidity()) {
      setError(index);
      isValid = false;
    } else {
      setOK(index);
      formData[index] = campo.value; // Adiciona o valor do campo ao array
    }
  });

  if (isValid) {
    // Redireciona para a próxima página
    window.location.href = "Contatos.html";

    // Exibe os dados do formulário no console (opcional)
    console.log(formData);
  } else {
    setError();
  }
}