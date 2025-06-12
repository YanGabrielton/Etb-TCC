<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Job4You</title>

    <!-- CSS global -->
    <link rel="stylesheet" href="/src/css/global.css">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração personalizada do Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#F59E0B', // Amarelo principal
                            600: '#D97706', // Tom mais escuro
                        },
                        dark: {
                            800: '#1F2937', // Tom escuro do menu
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="bg-white font-sans flex flex-col min-h-screen">

    <!-- MENU DE NAVEGAÇÃO -->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <!-- LOGO -->
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors"
                href="/index.php">Job4You</a>

            <!-- LINKS DO MENU (versão desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="/index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/sobre_nos.php">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors"
                    href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors"
                    href="/src/pages/login.php">Login</a>
            </div>

            <!-- BOTÃO HAMBÚRGUER (para mobile) -->
            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE (invisível até clicar) -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/sobre_nos.php">Sobre</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2"
                href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2"
                href="/src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL LOGIN -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">

            <!-- Título centralizado -->
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Login</h2>
            </div>

            <!-- Formulário de login -->
            <form id="loginForm" class="mt-8 space-y-6" action="../backend/includes/processa_login.php" method="POST">
                <div class="rounded-md shadow-sm space-y-4">

                    <!-- Campo de e-mail -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <!-- Ícone do e-mail à esquerda -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-envelope text-gray-400"></i>
                            </div>
                            <!-- Input do e-mail -->
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Seu e-mail">
                        </div>
                    </div>

<!-- Campo de senha -->
<div>
    <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
    <div class="mt-1 relative rounded-md shadow-sm">
        <!-- Ícone de cadeado à esquerda -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="bi bi-lock text-gray-400"></i>
        </div>
        <!-- Input de senha -->
        <input id="senha" name="senha" type="password" autocomplete="current-password" required
            class="py-2 pl-10 pr-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
            placeholder="Sua senha">
        <!-- Botão de visualização da senha -->
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <button type="button" id="togglePassword" aria-label="Mostrar/ocultar senha"
                class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <!-- Ícone dinâmico do olho -->
                <i id="eyeIcon" class="fas fa-eye"></i>
            </button>
        </div>
    </div>
</div>

                <!-- Lembrar-me + Esqueceu a senha -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-primary-500 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">Lembrar-me</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary-500 hover:text-primary-600">Esqueceu sua senha?</a>
                    </div>
                </div>

                <!-- Botão de envio -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Entrar
                    </button>
                </div>
            </form>

            <!-- Link para cadastro -->
            <div class="text-center">
                <p class="text-sm text-gray-600">Não tem uma conta?
                    <a href="./cadastro_usuario.php"
                        class="font-medium text-primary-500 hover:text-primary-600">Cadastre-se</a>
                </p>
            </div>

        </div>
    </main>

    <!-- RODAPÉ FIXO -->
    <footer class="bg-dark-800 py-6 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="/src/js/login.js"></script>
</body>

</html>