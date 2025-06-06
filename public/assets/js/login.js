// Função para alternar a visualização da senha
function togglePasswordVisibility(idInput, idIcon) {
    const input = document.getElementById(idInput);
    const icon = document.getElementById(idIcon);
  
    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      input.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }

  