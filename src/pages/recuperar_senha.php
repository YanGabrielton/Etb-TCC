<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Senha</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração personalizada do Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#F59E0B',
                            600: '#D97706',
                        },
                        dark: {
                            800: '#1F2937',
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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-white font-sans flex flex-col min-h-screen">

    <!-- MENU DE NAVEGAÇÃO -->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors" href="index.php">Job4You</a>
            
            <!-- LINKS DO MENU (versão desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="#">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors" href="./src/pages/login.php">Login</a>
            </div>

            <!-- BOTÃO HAMBÚRGUER (para mobile) -->
            <button class="md:hidden text-white focus:outline-none" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <i class="bi bi-list text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="#">Sobre</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" href="./src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">

            <!-- Título -->
            <div class="text-center">
                <i class="bi bi-shield-lock text-primary-500 text-5xl mb-4"></i>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">Recuperar Senha</h2>
                <p class="mt-2 text-sm text-gray-600">Digite seu e-mail para receber um link de recuperação</p>
            </div>

            <!-- Mensagens (serão preenchidas pelo PHP) -->
            <?php if (isset($_GET['status'])): ?>
                <div class="<?= $_GET['status'] === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> p-4 rounded-md text-center">
                    <?= htmlspecialchars($_GET['message'] ?? 'Operação concluída') ?>
                </div>
            <?php endif; ?>

            <!-- Formulário (action será definido no PHP) -->
            <form class="mt-8 space-y-6" action="processa_recuperacao.php" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Campo de e-mail -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" required
                                class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Seu e-mail cadastrado" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <!-- Botão de envio -->
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Enviar Link de Recuperação
                </button>
            </form>

            <!-- Link para login -->
            <div class="text-center">
                <p class="text-sm text-gray-600">Lembrou sua senha?
                    <a href="./login.php" class="font-medium text-primary-500 hover:text-primary-600">Faça login</a>
                </p>
            </div>
        </div>
    </main>

    <!-- RODAPÉ FIXO-->
    <footer class="bg-dark-800 py-6 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>