<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You - Prestadores</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Glider.js para o carrossel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css">
    <!-- Seu CSS global -->
    <link rel="stylesheet" href="/src/css/global.css">
    
    <style>
        /* Estilos personalizados */
        .prestador-card {
            transition: all 0.3s ease;
            min-width: 280px;
        }
        .prestador-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .glider-slide {
            padding: 0 15px;
        }
        .star-rating {
            color: #fbbf24; /* Cor âmbar para as estrelas */
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Menu de Navegação -->
    <nav class="bg-gray-800 text-white px-4 py-3 shadow-md">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
            <a class="text-2xl font-bold text-white hover:text-gray-300" href="/index.php">
                Job4You
            </a>

            <button class="md:hidden focus:outline-none text-white" type="button" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <div class="hidden w-full md:flex md:w-auto md:items-center" id="navbarNav">
                <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 items-center">
                    <li>
                        <a class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" 
                           href="/index.php">Home</a>
                    </li>
                    <li>
                        <a class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" 
                           href="#">Sobre</a>
                    </li>
                    <li>
                        <a class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" 
                           href="./cadastro_usuario.php">Cadastre-se</a>
                    </li>
                    <li>
                        <a class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium" 
                           href="/src/pages/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cabeçalho -->
    <header class="bg-white py-12 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                Nossos Prestadores
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Profissionais qualificados prontos para ajudar você
            </p>
        </div>
    </header>

    <!-- Carrossel de Prestadores -->
    <section class="container mx-auto py-8 px-4">
        <div class="relative">
            <div class="glider-contain">
                <div class="glider">
                    <!-- Prestador 1 -->
                    <div class="glider-slide">
                        <div class="bg-white rounded-lg shadow-md prestador-card p-6 text-center mx-auto">
                            <div class="h-40 bg-gray-200 rounded-full w-40 mx-auto mb-4 overflow-hidden">
                                <img src="/src/img/fotoperfil.jpg" alt="Prestador" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">Ana Silva</h3>
                            <p class="text-gray-600 text-sm mb-1">
                                Encanadora Residencial
                            </p>
                            <p class="text-gray-500 text-sm mb-2">
                                <i class="bi bi-geo-alt mr-1"></i> São Paulo, SP
                            </p>
                            <div class="flex justify-center star-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <span class="text-gray-500 text-xs ml-1">(42)</span>
                            </div>
                            <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium w-full">
                                Ver Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Prestador 2 -->
                    <div class="glider-slide">
                        <div class="bg-white rounded-lg shadow-md prestador-card p-6 text-center mx-auto">
                            <div class="h-40 bg-gray-200 rounded-full w-40 mx-auto mb-4 overflow-hidden">
                                <img src="/src/img/fotoperfil.jpg" alt="Prestador" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">Carlos Oliveira</h3>
                            <p class="text-gray-600 text-sm mb-1">
                                Eletricista
                            </p>
                            <p class="text-gray-500 text-sm mb-2">
                                <i class="bi bi-geo-alt mr-1"></i> Rio de Janeiro, RJ
                            </p>
                            <div class="flex justify-center star-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <span class="text-gray-500 text-xs ml-1">(38)</span>
                            </div>
                            <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium w-full">
                                Ver Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Prestador 3 -->
                    <div class="glider-slide">
                        <div class="bg-white rounded-lg shadow-md prestador-card p-6 text-center mx-auto">
                            <div class="h-40 bg-gray-200 rounded-full w-40 mx-auto mb-4 overflow-hidden">
                                <img src="/src/img/fotoperfil.jpg" alt="Prestador" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">Mariana Costa</h3>
                            <p class="text-gray-600 text-sm mb-1">
                                Pintora Residencial
                            </p>
                            <p class="text-gray-500 text-sm mb-2">
                                <i class="bi bi-geo-alt mr-1"></i> Belo Horizonte, MG
                            </p>
                            <div class="flex justify-center star-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span class="text-gray-500 text-xs ml-1">(56)</span>
                            </div>
                            <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium w-full">
                                Ver Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Prestador 4 -->
                    <div class="glider-slide">
                        <div class="bg-white rounded-lg shadow-md prestador-card p-6 text-center mx-auto">
                            <div class="h-40 bg-gray-200 rounded-full w-40 mx-auto mb-4 overflow-hidden">
                                <img src="/src/img/fotoperfil.jpg" alt="Prestador" class="h-full w-full object-cover">
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">João Santos</h3>
                            <p class="text-gray-600 text-sm mb-1">
                                Marceneiro
                            </p>
                            <p class="text-gray-500 text-sm mb-2">
                                <i class="bi bi-geo-alt mr-1"></i> Porto Alegre, RS
                            </p>
                            <div class="flex justify-center star-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                                <span class="text-gray-500 text-xs ml-1">(29)</span>
                            </div>
                            <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium w-full">
                                Ver Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <button aria-label="Previous" class="glider-prev hidden md:block absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md">
                    <i class="bi bi-chevron-left text-gray-700"></i>
                </button>
                <button aria-label="Next" class="glider-next hidden md:block absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md">
                    <i class="bi bi-chevron-right text-gray-700"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Modal de Perfil do Prestador -->
    <div id="prestadorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Cabeçalho do Modal -->
            <div class="sticky top-0 bg-white p-4 border-b flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Perfil do Prestador</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg text-2xl"></i>
                </button>
            </div>
            
            <!-- Corpo do Modal -->
            <div class="p-6">
                <!-- Seção Superior -->
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <!-- Foto e Favoritos -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img id="modalFoto" src="" alt="Foto do Prestador" 
                                 class="w-40 h-40 rounded-full object-cover border-4 border-blue-100">
                            <button id="favoritarBtn" class="absolute -bottom-2 -right-2 bg-white p-2 rounded-full shadow-md">
                                <i class="bi bi-heart text-2xl text-gray-400"></i>
                                <span id="favoritosCount" class="absolute text-xs font-bold">0</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Dados do Prestador -->
                    <div class="flex-grow">
                        <h2 id="modalNome" class="text-2xl font-bold text-gray-800 mb-2"></h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-gray-600"><i class="bi bi-calendar mr-2"></i> <span id="modalNascimento"></span></p>
                                <p class="text-gray-600"><i class="bi bi-telephone mr-2"></i> <span id="modalTelefone"></span></p>
                            </div>
                            <div>
                                <p class="text-gray-600"><i class="bi bi-geo-alt mr-2"></i> <span id="modalCidade"></span>, <span id="modalEstado"></span></p>
                                <p class="text-gray-600"><i class="bi bi-cash-stack mr-2"></i> R$ <span id="modalValor"></span>/hora</p>
                            </div>
                        </div>
                        
                        <!-- Descrição do Serviço -->
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-800 mb-1">Descrição do Serviço</h4>
                            <p id="modalDescricao" class="text-gray-600"></p>
                        </div>
                        
                        <!-- Botões de Ação -->
                        <div class="flex flex-wrap gap-3">
                            <!-- Botão Entrar em Contato (Dropdown) -->
                            <div class="relative">
                                <button id="contatoBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                                    <i class="bi bi-chat-left-text mr-2"></i> Entrar em Contato
                                    <i class="bi bi-chevron-down ml-2"></i>
                                </button>
                                <div id="contatoDropdown" class="hidden absolute z-10 mt-1 w-48 bg-white rounded-md shadow-lg">
                                    <div class="py-1">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 contato-option" data-type="whatsapp">
                                            <i class="bi bi-whatsapp mr-2 text-green-500"></i> WhatsApp
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 contato-option" data-type="email">
                                            <i class="bi bi-envelope mr-2 text-blue-500"></i> E-mail
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 contato-option" data-type="telefone">
                                            <i class="bi bi-telephone mr-2 text-gray-500"></i> Telefone
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 contato-option" data-type="instagram">
                                            <i class="bi bi-instagram mr-2 text-pink-500"></i> Instagram
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 contato-option" data-type="facebook">
                                            <i class="bi bi-facebook mr-2 text-blue-600"></i> Facebook
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <button id="reportarBtn" class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-md flex items-center">
                                <i class="bi bi-flag mr-2"></i> Reportar Prestador
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Divisor -->
                <div class="border-t border-gray-200 my-6"></div>
                
                <!-- Seção de Avaliações -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Avaliações do Prestador</h3>
                    
                    <!-- Média de Avaliações -->
                    <div class="flex items-center mb-6">
                        <div class="star-rating mr-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-gray-600"><span id="totalAvaliacoes">0</span> avaliações</span>
                    </div>
                    
                    <!-- Lista de Avaliações -->
                    <div id="avaliacoesContainer" class="space-y-4">
                        <!-- As avaliações serão carregadas dinamicamente aqui -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-0">© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.js"></script>
    <script src="/src/js/prestadores.js"></script>
    <script src="/src/js/modalPrestador.js"></script>
</body>
</html>