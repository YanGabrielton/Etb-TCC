<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálago de Serviços</title>

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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

</head>

<body class="bg-white font-sans flex flex-col min-h-screen">

    <!-- MENU DE NAVEGAÇÃO -->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <!-- LOGO DA PÁGINA -->
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors"
                href="index.php">Job4You</a>

            <!-- LINKS DO MENU (versão desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="#">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors"
                    href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
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
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="#">Sobre</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2"
                href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2"
                href="./src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- CABEÇALHO -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Encontre Serviços Informais em Diversas Categorias
                </h1>
                <p class="text-xl text-gray-600">Todas as categorias disponíveis estão listadas abaixo</p>
            </div>
        </section>

        <!-- CARDS DAS CATEGORIAS -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Babá -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-person-bounding-box text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Babá</h3>
                            <p class="text-gray-600 mb-6">Profissionais para cuidar de crianças com responsabilidade e
                                carinho.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Faxina e Limpeza Residencial -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-house-gear text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Faxina e Limpeza Residencial</h3>
                            <p class="text-gray-600 mb-6">Diaristas especializadas em manter seu lar limpo e organizado.
                            </p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Jardinagem -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-flower1 text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Jardinagem</h3>
                            <p class="text-gray-600 mb-6">Serviços de cuidado com jardins e áreas verdes.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Mudança e Frete -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-truck text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Mudança e Frete</h3>
                            <p class="text-gray-600 mb-6">Auxílio em mudanças e transporte de objetos com segurança.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Manutenção e Reparos Domésticos -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-tools text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Manutenção e Reparos Domésticos</h3>
                            <p class="text-gray-600 mb-6">Serviços como elétrica, hidráulica e pequenos consertos.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Reforço Escolar -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-book text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Reforço Escolar</h3>
                            <p class="text-gray-600 mb-6">Aulas particulares para apoio escolar de diversas matérias.
                            </p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Cuidador de Idoso -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="fas fa-wheelchair text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Cuidador de Idoso</h3>
                            <p class="text-gray-600 mb-6">Profissionais preparados para cuidar de idosos com atenção e
                                respeito.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Passeador de Cães -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-heart-pulse text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Passeador de Cães</h3>
                            <p class="text-gray-600 mb-6">Serviço de passeio para seu pet com carinho e
                                responsabilidade.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Cozinheiro -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-egg-fried text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Cozinheiro</h3>
                            <p class="text-gray-600 mb-6">Profissionais que preparam refeições com sabor e qualidade.
                            </p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Reparos de Roupas (Costureiro) -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-scissors text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Reparos de Roupas (Costureiro)</h3>
                            <p class="text-gray-600 mb-6">Ajustes e consertos em peças de roupas de forma prática e
                                rápida.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Fotógrafo Freelance -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-camera text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Fotógrafo Freelance</h3>
                            <p class="text-gray-600 mb-6">Registros de momentos especiais com criatividade e técnica.
                            </p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>

                    <!-- Esteticista -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-brush text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Esteticista</h3>
                            <p class="text-gray-600 mb-6">Cuidados com beleza como designer de sobrancelhas, unhas e
                                cabelo.</p>
                            <a href="/src/pages/prestadores.php"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RODAPÉ FIXO -->
        <footer class="bg-dark-800 py-6 text-white mt-auto">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <p>© 2025 Job4You - Todos os direitos reservados.</p>
            </div>
        </footer>

        <!-- SCRIPT JS INTEGRADO (menu hamburguer responsivo) -->
        <script>
            document.getElementById('menuButton').addEventListener('click', function () {
                const menu = document.getElementById('mobileMenu');
                menu.classList.toggle('hidden'); // Mostra ou esconde o menu mobile
            });
        </script>

</body>
</html>