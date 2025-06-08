<?php
session_start();
include '../backend/config/ConexaoBanco.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You - Prestadores</title>

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

    <!-- Glider CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css">
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
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors" href="./src/pages/login.php">Login</a>
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
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" href="./src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Nossos Prestadores</h1>
                <p class="text-xl text-gray-600">Profissionais qualificados prontos para ajudar você</p>
            </div>
        </section>

        <!-- Carrossel de Prestadores -->
        <section class="py-12 bg-gray-50 relative">
            <div class="max-w-7xl mx-auto px-6 relative">
                <div class="glider-contain">
                    <div class="glider">
                        <!-- Prestador 1 -->
                        <div class="px-2">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                                <div class="p-6 text-center">
                                    <div class="h-32 w-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                                        <img src="/src/img/fotoperfil.jpg" alt="Ana Silva" class="h-full w-full object-cover">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Ana Silva</h3>
                                    <p class="text-gray-600 mb-1">Encanadora Residencial</p>
                                    <p class="text-gray-500 text-sm mb-3">
                                        <i class="bi bi-geo-alt mr-1"></i> São Paulo, SP
                                    </p>
                                    <div class="flex justify-center text-yellow-400 mb-4">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <span class="text-gray-500 text-xs ml-1">(42)</span>
                                    </div>
                                    <button onclick="openModal('Ana Silva', 'Encanadora Residencial', 'São Paulo, SP', '4.5', '42', '/src/img/fotoperfil.jpg')" 
                                            class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                        Ver Perfil
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prestador 2 -->
                        <div class="px-2">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                                <div class="p-6 text-center">
                                    <div class="h-32 w-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                                        <img src="/src/img/fotoperfil.jpg" alt="Carlos Oliveira" class="h-full w-full object-cover">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Carlos Oliveira</h3>
                                    <p class="text-gray-600 mb-1">Eletricista</p>
                                    <p class="text-gray-500 text-sm mb-3">
                                        <i class="bi bi-geo-alt mr-1"></i> Rio de Janeiro, RJ
                                    </p>
                                    <div class="flex justify-center text-yellow-400 mb-4">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <span class="text-gray-500 text-xs ml-1">(38)</span>
                                    </div>
                                    <button onclick="openModal('Carlos Oliveira', 'Eletricista', 'Rio de Janeiro, RJ', '4.0', '38', '/src/img/fotoperfil.jpg')" 
                                            class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                        Ver Perfil
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prestador 3 -->
                        <div class="px-2">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                                <div class="p-6 text-center">
                                    <div class="h-32 w-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                                        <img src="/src/img/fotoperfil.jpg" alt="Mariana Costa" class="h-full w-full object-cover">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mariana Costa</h3>
                                    <p class="text-gray-600 mb-1">Pintora Residencial</p>
                                    <p class="text-gray-500 text-sm mb-3">
                                        <i class="bi bi-geo-alt mr-1"></i> Belo Horizonte, MG
                                    </p>
                                    <div class="flex justify-center text-yellow-400 mb-4">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <span class="text-gray-500 text-xs ml-1">(56)</span>
                                    </div>
                                    <button onclick="openModal('Mariana Costa', 'Pintora Residencial', 'Belo Horizonte, MG', '5.0', '56', '/src/img/fotoperfil.jpg')" 
                                            class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                        Ver Perfil
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prestador 4 -->
                        <div class="px-2">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                                <div class="p-6 text-center">
                                    <div class="h-32 w-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                                        <img src="/src/img/fotoperfil.jpg" alt="João Santos" class="h-full w-full object-cover">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">João Santos</h3>
                                    <p class="text-gray-600 mb-1">Marceneiro</p>
                                    <p class="text-gray-500 text-sm mb-3">
                                        <i class="bi bi-geo-alt mr-1"></i> Porto Alegre, RS
                                    </p>
                                    <div class="flex justify-center text-yellow-400 mb-4">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                        <span class="text-gray-500 text-xs ml-1">(29)</span>
                                    </div>
                                    <button onclick="openModal('João Santos', 'Marceneiro', 'Porto Alegre, RS', '3.5', '29', '/src/img/fotoperfil.jpg')" 
                                            class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                        Ver Perfil
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button aria-label="Previous" class="glider-prev absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-3 rounded-full shadow-md hover:bg-gray-100 transition-colors">
                        <i class="bi bi-chevron-left text-gray-700 text-xl"></i>
                    </button>
                    <button aria-label="Next" class="glider-next absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-3 rounded-full shadow-md hover:bg-gray-100 transition-colors">
                        <i class="bi bi-chevron-right text-gray-700 text-xl"></i>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal de Perfil -->
    <div id="prestadorModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Cabeçalho do Modal -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800" id="modalNome"></h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="bi bi-x-lg text-2xl"></i>
                    </button>
                </div>
                
                <!-- Corpo do Modal -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Foto e Info Básica -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img id="modalFoto" src="" alt="Foto do Prestador" class="w-40 h-40 rounded-full object-cover border-4 border-primary-100 mx-auto">
                        </div>
                        
                        <div class="mt-4 text-center">
                            <p class="text-gray-600 font-medium" id="modalProfissao"></p>
                            <p class="text-gray-500 text-sm mt-1">
                                <i class="bi bi-geo-alt mr-1"></i> <span id="modalLocalizacao"></span>
                            </p>
                            
                            <div class="flex justify-center items-center mt-3">
                                <div class="text-yellow-400 mr-2" id="modalEstrelas"></div>
                                <span class="text-gray-500 text-sm">(<span id="modalAvaliacoes"></span> avaliações)</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detalhes -->
                    <div class="flex-grow">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Sobre</h3>
                            <p class="text-gray-600">Profissional altamente qualificado com experiência comprovada na área. Comprometido com a excelência no atendimento e satisfação do cliente.</p>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Serviços Oferecidos</h3>
                            <ul class="list-disc list-inside text-gray-600">
                                <li>Instalação e manutenção de encanamento</li>
                                <li>Reparos em geral</li>
                                <li>Desentupimento</li>
                                <li>Instalação de torneiras e chuveiros</li>
                            </ul>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-gray-600"><i class="bi bi-cash-stack mr-2"></i> <span class="font-medium">R$ 80,00/h</span></p>
                                <p class="text-gray-600"><i class="bi bi-clock mr-2"></i> <span class="font-medium">8h - 18h</span></p>
                            </div>
                            <div>
                                <p class="text-gray-600"><i class="bi bi-check-circle mr-2"></i> <span class="font-medium">Verificado</span></p>
                                <p class="text-gray-600"><i class="bi bi-calendar-check mr-2"></i> <span class="font-medium">Disponível</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botões de Ação -->
                <div class="flex flex-wrap gap-3 mt-6">
                    <button class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-whatsapp mr-2"></i> Contatar
                    </button>
                    <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-heart mr-2"></i> Favoritar
                    </button>
                    <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-share mr-2"></i> Compartilhar
                    </button>
                </div>
                
                <!-- Avaliações -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Avaliações</h3>
                    
                    <div class="space-y-4">
                        <!-- Avaliação 1 -->
                        <div class="border-b border-gray-200 pb-4">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 mr-3"></div>
                                    <div>
                                        <p class="font-medium text-gray-800">Maria Souza</p>
                                        <div class="flex text-yellow-400 text-sm">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-500 text-sm">2 semanas atrás</p>
                            </div>
                            <p class="text-gray-600 mt-2">Excelente profissional! Resolveu meu problema rapidamente e com ótimo custo-benefício.</p>
                        </div>
                        
                        <!-- Avaliação 2 -->
                        <div class="border-b border-gray-200 pb-4">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 mr-3"></div>
                                    <div>
                                        <p class="font-medium text-gray-800">José Oliveira</p>
                                        <div class="flex text-yellow-400 text-sm">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-500 text-sm">1 mês atrás</p>
                            </div>
                            <p class="text-gray-600 mt-2">Bom atendimento, mas chegou com 30 minutos de atraso.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RODAPÉ FIXO -->
    <footer class="bg-dark-800 py-6 text-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.js"></script>
    <script>
        // Menu mobile
        document.getElementById('menuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        // Inicializa o carrossel
        new Glider(document.querySelector('.glider'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            },
            responsive: [
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // Funções do Modal
        function openModal(nome, profissao, localizacao, avaliacao, numAvaliacoes, foto) {
            document.getElementById('modalNome').textContent = nome;
            document.getElementById('modalProfissao').textContent = profissao;
            document.getElementById('modalLocalizacao').textContent = localizacao;
            document.getElementById('modalFoto').src = foto;
            document.getElementById('modalAvaliacoes').textContent = numAvaliacoes;
            
            // Criar estrelas de avaliação
            const estrelasContainer = document.getElementById('modalEstrelas');
            estrelasContainer.innerHTML = '';
            const rating = parseFloat(avaliacao);
            
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('i');
                if (i <= Math.floor(rating)) {
                    star.className = 'bi bi-star-fill';
                } else if (i === Math.ceil(rating) && rating % 1 > 0) {
                    star.className = 'bi bi-star-half';
                } else {
                    star.className = 'bi bi-star';
                }
                estrelasContainer.appendChild(star);
            }
            
            document.getElementById('prestadorModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('prestadorModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Fechar modal ao clicar fora
        document.getElementById('prestadorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>