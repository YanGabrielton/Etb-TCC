// FUNCIONALIDADES DO LOGIN

// Aguarda todo o conteúdo da página carregar antes de executar os scripts
document.addEventListener('DOMContentLoaded', function() {

    // === BOTÃO PARA MOSTRAR/OCULTAR SENHA ===
    const togglePasswordButton = document.getElementById('togglePassword'); // botão de mostrar/ocultar senha

    // Verifica se o botão existe na página antes de continuar
    if (togglePasswordButton) {
        togglePasswordButton.addEventListener('click', function() {
            const senhaInput = document.getElementById('senha'); // campo de senha
            const eyeIcon = document.getElementById('eyeIcon');   // ícone de olho

            // Alterna entre mostrar e ocultar a senha
            if (senhaInput.type === "password") {
                senhaInput.type = "text"; // mostra a senha
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash"); // troca o ícone para olho cortado
            } else {
                senhaInput.type = "password"; // oculta a senha
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye"); // troca o ícone para olho normal
            }
        });
    }

    // === FUNCIONALIDADE DO MENU MOBILE ===
    const menuButton = document.getElementById('menuButton'); // botão do menu mobile

    // Verifica se o botão do menu existe
    if (menuButton) {
        menuButton.addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu'); // menu que será mostrado ou ocultado
            menu.classList.toggle('hidden'); // adiciona ou remove a classe 'hidden' do Tailwind
        });
    }

    // === VALIDAÇÃO DO FORMULÁRIO DE LOGIN ===
    const loginForm = document.getElementById('loginForm'); // formulário de login

    // Verifica se o formulário existe
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email'); // campo de e-mail
            const senha = document.getElementById('senha'); // campo de senha

            // Verifica se os campos estão vazios
            if (!email.value || !senha.value) {
                e.preventDefault(); // impede o envio do formulário
                alert('Por favor, preencha todos os campos!'); // exibe alerta ao usuário
            }

            // (aqui poderá ser feita a verificação no banco de dados via PHP)
        });
    }

});
