<?php
session_start();
require '../backend/config/ConexaoBanco.php';

$db = new DataBase();
$conn = $db->getConnection();

// Verifica se uma categoria foi selecionada
$categoria_selecionada = isset($_GET['categoria']) ? (int)$_GET['categoria'] : null;
$prestadores = [];

if ($categoria_selecionada) {
    // Busca prestadores da categoria selecionada usando a view ViewPublicacao
    $sql = "SELECT * FROM ViewPublicacao WHERE Categoria = (SELECT Nome FROM CategoriaServico WHERE ID = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_selecionada);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $prestadores[] = $row;
    }
    
    // Busca o nome da categoria selecionada
    $sql_categoria = "SELECT Nome FROM CategoriaServico WHERE ID = ?";
    $stmt = $conn->prepare($sql_categoria);
    $stmt->bind_param("i", $categoria_selecionada);
    $stmt->execute();
    $categoria_nome = $stmt->get_result()->fetch_assoc()['Nome'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You - Prestadores</title>

    <!-- CSS global -->
    <link rel="stylesheet" href="/src/css/output.css">

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

  
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
           
           <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors" href="/index.php">Job4You</a>
            
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="/index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/sobre_nos.php">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/perfil_prestador.php">Meu Perfil</a>                 
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors" 
                   href="../backend/includes/logout.php">Sair</a>
            </div>

            <!-- Botão do Menu Mobile -->
            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Menu Mobile -->
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
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <?= isset($categoria_nome) ? "Prestadores de $categoria_nome" : 'Encontre Serviços Informais em Diversas Categorias' ?>
                </h1>
                <p class="text-xl text-gray-600">
                    <?= isset($categoria_nome) ? 'Profissionais qualificados nesta categoria' : 'Todas as categorias disponíveis estão listadas abaixo' ?>
                </p>
            </div>
        </section>

        <?php if (isset($categoria_selecionada)): ?>
            <?php if (count($prestadores) > 0): ?>
                <!-- Carrossel de Prestadores -->
                <section class="py-12 bg-gray-50 relative">
                    <div class="max-w-7xl mx-auto px-6 relative">
                        <div class="glider-contain">
                            <div class="glider">
                                <?php foreach ($prestadores as $prestador): 
                                    $foto = $prestador['FotoUsuario'] ? '/src/img/uploads/' . $prestador['FotoUsuario'] : '/src/img/fotoperfil.jpg';
                                ?>
                                <!-- Prestador -->
                                <div class="px-2">
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                                        <div class="p-6 text-center">
                                            <div class="h-32 w-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                                                <img src="<?= htmlspecialchars($foto) ?>" alt="<?= htmlspecialchars($prestador['NomeUsuario']) ?>" class="h-full w-full object-cover">
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($prestador['NomeUsuario']) ?></h3>
                                            <p class="text-gray-600 mb-1"><?= htmlspecialchars($prestador['Categoria']) ?></p>
                                            <p class="text-gray-500 text-sm mb-3">
                                                <i class="bi bi-cash-stack mr-1"></i> <?= htmlspecialchars('R$ ' . number_format($prestador['Valor'], 2, ',', '.')) ?>
                                            </p>
                                            <div class="flex justify-center text-yellow-400 mb-4">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                                <span class="text-gray-500 text-xs ml-1">(<?= htmlspecialchars($prestador['QuantidadeFavorito']) ?>)</span>
                                            </div>
                                          <button onclick="prestadorModal.open(
                                               '<?= addslashes($prestador['NomeUsuario']) ?>', 
                                               '<?= addslashes($prestador['Categoria']) ?>', 
                                               '<?= addslashes('R$ ' . number_format($prestador['Valor'], 2, ',', '.')) ?>', 
                                               '4.5', 
                                               '<?= addslashes($prestador['QuantidadeFavorito']) ?>', 
                                               '<?= addslashes($foto) ?>',
                                               '<?= addslashes($prestador['Sobre']) ?>',
                                               '<?= addslashes($prestador['Whatsapp'] ?? '') ?>',
                                               '<?= addslashes($prestador['Celular'] ?? '') ?>',
                                               '<?= addslashes($prestador['Facebook'] ?? '') ?>'
                                           )" 
                                               class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                               Ver Perfil
                                           </button>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
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
            <?php else: ?>
                <!-- Mensagem quando não há prestadores -->
                <section class="py-12 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-6 text-center">
                        <p class="text-gray-600 text-lg mb-6">Nenhum prestador disponível nesta categoria no momento.</p>
                        <a href="servicos.php" class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                            Voltar para categorias
                        </a>
                    </div>
                </section>
            <?php endif; ?>
        <?php else: ?>
        <!-- CARDS DAS CATEGORIAS -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Babá -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02]">
                        <div class="p-8 text-center">
                            <i class="bi bi-person-bounding-box text-5xl text-yellow-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Babá</h3>
                            <p class="text-gray-600 mb-6">Profissionais para cuidar de crianças com responsabilidade e carinho.</p>
                            <a href="servicos.php?categoria=1"
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
                            <p class="text-gray-600 mb-6">Diaristas especializadas em manter seu lar limpo e organizado.</p>
                            <a href="servicos.php?categoria=2"
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
                            <a href="servicos.php?categoria=3"
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
                            <a href="servicos.php?categoria=4"
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
                            <a href="servicos.php?categoria=5"
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
                            <p class="text-gray-600 mb-6">Aulas particulares para apoio escolar de diversas matérias.</p>
                            <a href="servicos.php?categoria=6"
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
                            <p class="text-gray-600 mb-6">Profissionais preparados para cuidar de idosos com atenção e respeito.</p>
                            <a href="servicos.php?categoria=7"
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
                            <p class="text-gray-600 mb-6">Serviço de passeio para seu pet com carinho e responsabilidade.</p>
                            <a href="servicos.php?categoria=8"
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
                            <p class="text-gray-600 mb-6">Profissionais que preparam refeições com sabor e qualidade.</p>
                            <a href="servicos.php?categoria=9"
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
                            <p class="text-gray-600 mb-6">Ajustes e consertos em peças de roupas de forma prática e rápida.</p>
                            <a href="servicos.php?categoria=10"
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
                            <p class="text-gray-600 mb-6">Registros de momentos especiais com criatividade e técnica.</p>
                            <a href="servicos.php?categoria=11"
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
                            <p class="text-gray-600 mb-6">Cuidados com beleza como designer de sobrancelhas, unhas e cabelo.</p>
                            <a href="servicos.php?categoria=13"
                                class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                Ver Prestadores
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
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
                                <i class="bi bi-cash-stack mr-1"></i> <span id="modalValor"></span>
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
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Descrição</h3>
                            <p class="text-gray-600" id="modalSobre"></p>
                        </div>
                        
                        <!-- <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Serviços Oferecidos</h3>
                            <ul class="list-disc list-inside text-gray-600">
                                <li>Serviço 1</li>
                                <li>Serviço 2</li>
                                <li>Serviço 3</li>
                            </ul>
                        </div>              Retirando essa parte ela o design do verificad o e disponivel fica feio,-->
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-gray-600"><i class="bi bi-cash-stack mr-2"></i> <span class="font-medium" id="modalValor2"></span></p>
                                
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
                   
                    <a id="modalWhatsapp" href="#" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-whatsapp mr-2"></i> WhatsApp
                        </a>
                    <a id="modalCelular" href="#" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-telephone mr-2"></i> Celular
                    </a>
                    <a id="modalFacebook" href="#" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-facebook mr-2"></i> Facebook
                    </a>
                    <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md font-medium flex items-center transition-colors">
                        <i class="bi bi-heart mr-2"></i> Favoritar
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
    const prestadorModal = {
        open: function(nome, profissao, valor, avaliacao, numAvaliacoes, foto, sobre, whatsapp, celular, facebook) {
            // Configurações básicas do modal
            document.getElementById('modalNome').textContent = nome;
            document.getElementById('modalProfissao').textContent = profissao;
            document.getElementById('modalValor').textContent = valor;
            document.getElementById('modalValor2').textContent = valor;
            document.getElementById('modalFoto').src = foto;
            document.getElementById('modalAvaliacoes').textContent = numAvaliacoes;
            document.getElementById('modalSobre').textContent = sobre || 'Profissional altamente qualificado com experiência comprovada na área.';
            
            // Configurar links de contato (somente se existirem)
            this.configurarContato('modalWhatsapp', whatsapp, 'https://wa.me/55');
            this.configurarContato('modalCelular', celular, 'tel:');
            this.configurarContato('modalFacebook', facebook);
            
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
        },
        
        configurarContato: function(elementId, contato, prefix = '') {
            const elemento = document.getElementById(elementId);
            if (contato && contato.trim() !== '') {
                elemento.href = prefix + contato;
                elemento.target = '_blank';
                elemento.classList.remove('hidden');
            } else {
                elemento.classList.add('hidden');
            }
        },
        
        close: function() {
            document.getElementById('prestadorModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    };

    // Menu mobile
    document.getElementById('menuButton').addEventListener('click', function() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    });

    // Inicializa o carrossel
    document.addEventListener('DOMContentLoaded', function() {
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
    });

    // Fechar modal ao clicar fora
    document.getElementById('prestadorModal').addEventListener('click', function(e) {
        if (e.target === this) {
            prestadorModal.close();
        }
    });
</script>
</body>
</html>