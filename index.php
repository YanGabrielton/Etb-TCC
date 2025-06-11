<!-- PHP -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You</title>

    <!-- CSS global -->
    <link rel="stylesheet" href="/src/css/global.css">
    
    <!-- Tailwind CSS direto da CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração personalizada do Tailwind (cores e fontes) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#F59E0B', // Amarelo principal do projeto
                            600: '#D97706', // Tom mais escuro para hover
                        },
                        dark: {
                            800: '#1F2937', // Tom escuro usado no menu e footer
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'], // Fonte principal
                    },
                }
            }
        }
    </script>

    <!-- Ícones do Font Awesome (para o menu hamburguer) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonte Inter importada do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-white font-sans flex flex-col min-h-screen">

    <!-- MENU DE NAVEGAÇÃO -->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <!-- LOGO -->
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors" href="index.php">Job4You</a>

            <!-- LINKS DO MENU (versão desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="#">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors" 
                   href="./src/pages/login.php">Login</a>
            </div>

            <!-- BOTÃO HAMBÚRGUER (para mobile) -->
            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE (invisível até clicar) -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/sobre_nos.php">Sobre</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" 
               href="./src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL DA HOME -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-6 py-8 md:py-12 h-full">
            <div class="flex flex-col md:flex-row items-center justify-center h-full gap-8 md:gap-12">

                <!-- IMAGEM DA HOME -->
                <div class="md:w-1/2 flex justify-center items-center h-full">
                    <img src="/src/img/img_index.jpg" alt="mulher apontando para lupa de pesquisa" class="hero-image rounded-lg object-contain">
                </div>

                <!-- TEXTO E BOTÕES DE AÇÃO -->
                <div class="md:w-1/2 text-center md:text-left flex flex-col justify-center h-full py-8">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Encontre ou divulgue serviços informais facilmente
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto md:mx-0">
                        Na Job4You você encontra prestadores de serviços confiáveis ou pode anunciar
                        seu trabalho para milhares de clientes!
                    </p>

                    <!-- BOTÕES: levam para as páginas de serviços e cadastro -->
                    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                        <a href="./src/pages/servicos.php" 
                           class="bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 px-6 rounded-full shadow-sm transition-colors">
                            Ver Serviços
                        </a>
                        <a href="/src/pages/cadastro_servico.php" 
                           class="border border-gray-300 hover:border-primary-500 text-gray-700 hover:text-primary-500 font-medium py-3 px-6 rounded-full transition-colors">
                            Cadastrar Serviço
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- RODAPÉ FIXO -->
    <footer class="bg-dark-800 py-6 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- SCRIPT JS INTEGRADO (menu hamburguer responsivo) -->
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden'); // Mostra ou esconde o menu mobile
        });
    </script>

</body>
</html>
