function togglePasswordVisibility() {
    const passwordInput = document.getElementById('passwordInput');
    const passwordToggle = document.querySelector('.password-toggle');
  
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      passwordToggle.style.backgroundImage = "url('../img/olho-fechado.png')";
    } else {
      passwordInput.type = 'password';
      passwordToggle.style.backgroundImage = "url('../img/olho-aberto.png')";
    }
  }
  