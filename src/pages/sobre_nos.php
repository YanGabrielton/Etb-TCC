<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You - Sobre Nós</title>

    <!-- Tailwind CSS direto da CDN -->
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
                    boxShadow: {
                        'soft': '0 10px 30px -15px rgba(0, 0, 0, 0.1)',
                        'card': '0 4px 20px rgba(0, 0, 0, 0.08)',
                    }
                }
            }
        }
    </script>

    <!-- Ícones do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(90deg, #F59E0B, #D97706);
        }
    </style>
</head>

<body class="bg-white font-sans flex flex-col min-h-screen text-gray-700 leading-relaxed">

    <!-- MENU DE NAVEGAÇÃO -->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <!-- LOGO -->
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors" href="index.php">Job4You</a>

            <!-- LINKS DO MENU (versão desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/sobre_nos.php">Sobre Nós</a>
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
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="#">Sobre</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" 
               href="./src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="flex-grow">
        <!-- SEÇÃO SOBRE NÓS -->
        <section id="sobre" class="max-w-6xl mx-auto px-6 py-16 md:py-24">
            <!-- CABEÇALHO -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1 bg-primary-50 text-primary-600 rounded-full text-sm font-medium mb-3">Sobre Nós</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    Conectando <span class="gradient-text">profissionais</span> e <span class="gradient-text">clientes</span>
                </h2>
                <div class="w-24 h-1 bg-primary-500 mx-auto"></div>
            </div>
            
            <!-- CONTEÚDO PRINCIPAL -->
            <div class="flex flex-col lg:flex-row gap-12 xl:gap-16">
                <!-- COLUNA ESQUERDA -->
                <div class="lg:w-1/2 space-y-8">
                    <!-- BLOCO HISTÓRIA -->
                    <div class="bg-white p-8 rounded-xl shadow-card transition-all hover:shadow-soft">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary-100 p-2 rounded-lg mr-4">
                                <i class="bi bi-building text-primary-600 text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-900">Nossa História</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Fundada em 2025, a Job4You surgiu para revolucionar o mercado de serviços informais, criando pontes entre quem oferece e quem precisa de serviços.
                        </p>
                        <p class="text-gray-600">
                            Nosso propósito é conectar clientes e prestadores de serviços informais por meio de soluções digitais especializadas, proporcionando uma experiência segura e eficiente para todos.
                        </p>
                    </div>
                    
                    <!-- BLOCO MISSÃO -->
                    <div class="bg-white p-8 rounded-xl shadow-card transition-all hover:shadow-soft">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary-100 p-2 rounded-lg mr-4">
                                <i class="bi bi-bullseye text-primary-600 text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-900">Nossa Missão</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Promover o acesso a serviços de qualidade de forma ágil e confiável, incentivando um ambiente de confiança e transparência.
                        </p>
                        <div class="bg-primary-50 border-l-4 border-primary-500 p-4 rounded-r-lg">
                            <p class="text-gray-700 italic">
                                "Facilitar conexões que transformam vidas e negócios através da tecnologia."
                            </p>
                        </div>
                    </div>
                    
                    <!-- BLOCO INFORMAÇÕES -->
                    <div class="bg-white p-8 rounded-xl shadow-card transition-all hover:shadow-soft">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary-100 p-2 rounded-lg mr-4">
                                <i class="bi bi-info-circle text-primary-600 text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-900">Informações Institucionais</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="bi bi-geo-alt-fill text-primary-500 text-lg mr-3 mt-1"></i>
                                <p class="text-gray-600">QS 07 Lote 02/08, Avenida Águas Claras – Vila Areal – DF, CEP 71966-700</p>
                            </div>
                            <div class="flex items-start">
                                <i class="bi bi-file-text-fill text-primary-500 text-lg mr-3 mt-1"></i>
                                <p class="text-gray-600">CNPJ 35.033.157/0001-06</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- COLUNA DIREITA -->
                <div class="lg:w-1/2 space-y-8">
                    <!-- BLOCO SOLUÇÃO -->
                    <div class="bg-white p-8 rounded-xl shadow-card transition-all hover:shadow-soft">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary-100 p-2 rounded-lg mr-4">
                                <i class="bi bi-lightbulb text-primary-600 text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-900">Nossa Solução</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Diante do crescimento do mercado informal, criamos uma plataforma digital centralizada que resolve os principais problemas de comunicação entre prestadores e clientes.
                        </p>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <h4 class="font-medium text-gray-800 mb-2">O Desafio</h4>
                            <p class="text-gray-600">
                                Profissionais autônomos enfrentam dificuldades como baixa visibilidade, falta de padronização e problemas de comunicação com clientes.
                            </p>
                        </div>
                        <div class="bg-primary-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-800 mb-2">Nossa Resposta</h4>
                            <p class="text-gray-600">
                                Um catálogo de serviços intuitivo que simplifica a conexão, oferecendo ferramentas para ambos os lados.
                            </p>
                        </div>
                    </div>
                    
                    <!-- BLOCO VANTAGENS -->
                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 p-8 rounded-xl text-white">
                        <div class="flex items-center mb-6">
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-4">
                                <i class="bi bi-stars text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold">Vantagens Exclusivas</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start bg-white bg-opacity-10 p-4 rounded-lg backdrop-blur-sm">
                                <i class="bi bi-search text-lg mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-medium">Visibilidade</h4>
                                    <p class="text-white text-opacity-90 text-sm">Maior alcance para prestadores</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-white bg-opacity-10 p-4 rounded-lg backdrop-blur-sm">
                                <i class="bi bi-shield-check text-lg mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-medium">Segurança</h4>
                                    <p class="text-white text-opacity-90 text-sm">Perfis verificados</p>
                                </div>
                            </div>
                            <div class="flex items-start bg-white bg-opacity-20 p-6 rounded-lg backdrop-blur-sm md:col-span-2">
                                <div class="flex-shrink-0 mr-4">
                                    <i class="bi bi-chat-square-dots text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-lg mb-2">Comunicação Direta e Eficiente</h4>
                                    <p class="text-white text-opacity-90">
                                        Nossa plataforma oferece contato direto e fácil apenas com um clique.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER FIXO -->
    <footer class="bg-dark-800 py-6 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>