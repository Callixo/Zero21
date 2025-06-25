function formatarNumeroTelefone(numero) {
  const apenasDigitos = numero.replace(/\D/g, '');
  const regex = /^(\d{2})(\d{5})(\d{4})$/;
  const telefoneFormatado = apenasDigitos.replace(regex, '($1) $2-$3');
  return telefoneFormatado;
}

const telCelInput = document.getElementById('telefone_celular');
const telFixoInput = document.getElementById('telefone_fixo');

telCelInput.addEventListener('input', function() {
  telCelInput.value = formatarNumeroTelefone(telCelInput.value);
});

telFixoInput.addEventListener('input', function() {
  telFixoInput.value = formatarNumeroTelefone(telFixoInput.value);
});






