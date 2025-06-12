<?php
session_start();
require '../backend/config/ConexaoBanco.php';

$db = new DataBase();
$conn = $db->getConnection();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id_usuario'];

// Busca dados do usuário usando a view ViewUsuarioLogin
$sql_usuario = "SELECT * FROM ViewUsuarioLogin WHERE ID = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$usuario = $stmt_usuario->get_result()->fetch_assoc();

// Busca serviços do prestador usando a view ViewPublicacao
$sql_servicos = "SELECT * FROM ViewPublicacao WHERE IDPublicacao IN 
                (SELECT ID FROM PublicacaoServico WHERE FKUsuario = ?)";
$stmt_servicos = $conn->prepare($sql_servicos);
$stmt_servicos->bind_param("i", $usuario_id);
$stmt_servicos->execute();
$servicos = $stmt_servicos->get_result()->fetch_all(MYSQLI_ASSOC);

// Busca avaliações dos serviços
$avaliacoes = [];
$media_avaliacoes = 0;
$total_avaliacoes = 0;

if (!empty($servicos)) {
    $servico_ids = array_column($servicos, 'IDPublicacao');
    $placeholders = implode(',', array_fill(0, count($servico_ids), '?'));
    
    $sql_avaliacoes = "SELECT * FROM ViewAvaliacaoServico 
                      WHERE IDPublicacao IN ($placeholders)";
    $stmt_avaliacoes = $conn->prepare($sql_avaliacoes);
    $stmt_avaliacoes->bind_param(str_repeat('i', count($servico_ids)), ...$servico_ids);
    $stmt_avaliacoes->execute();
    $avaliacoes = $stmt_avaliacoes->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Calcula média de avaliações
    if (!empty($avaliacoes)) {
        $total_avaliacoes = count($avaliacoes);
        $soma = array_sum(array_column($avaliacoes, 'Nota'));
        $media_avaliacoes = round($soma / $total_avaliacoes, 1);
    }
}

// Fecha a conexão
$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu Perfil - Job4You</title>
    
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

    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>

<body class="bg-white font-sans flex flex-col min-h-screen">
    <!-- MENU DE NAVEGAÇÃO -->
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

            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/sobre_nos.php">Sobre</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" 
               href="../backend/includes/logout.php">Sair</a>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL DO PERFIL -->
    <main class="flex-grow">
        <div class="max-w-4xl mx-auto px-6 py-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                
                <!-- CABEÇALHO DO PERFIL -->
                <div class="bg-dark-800 text-white px-8 py-6">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="relative">
                            <img src="<?= htmlspecialchars($usuario['Foto'] ?? '', ENT_QUOTES, 'UTF-8') ? '/src/img/uploads/' . $usuario['Foto'] : '/src/img/fotoperfil.jpg' ?>" 
                                 alt="Foto de perfil" 
                                 class="w-32 h-32 rounded-full border-4 border-primary-500 object-cover">
                            <button class="absolute bottom-2 right-2 bg-primary-500 hover:bg-primary-600 text-white rounded-full p-2">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl font-bold"><?= htmlspecialchars($usuario['Nome'] ?? '', ENT_QUOTES, 'UTF-8') ?></h1>
                            <p class="text-gray-300 mt-1"><?= htmlspecialchars($usuario['Email'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                            <div class="mt-3 flex justify-center md:justify-start gap-2">
                                <span class="bg-blue-500/10 text-blue-500 px-3 py-1 rounded-full text-sm">Prestador</span>
                                <span class="bg-green-500/10 text-green-500 px-3 py-1 rounded-full text-sm">
                                    <?= htmlspecialchars($usuario['StatusUsuario'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ABA DE NAVEGAÇÃO -->
                <div class="border-b border-gray-200">
                    <nav class="flex overflow-x-auto">
                        <a href="#perfil" class="border-b-2 border-primary-500 text-primary-500 px-6 py-4 font-medium whitespace-nowrap">
                            <i class="fas fa-user-circle mr-2"></i> Perfil
                        </a>
                        <a href="#servico" class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 px-6 py-4 font-medium whitespace-nowrap">
                            <i class="fas fa-briefcase mr-2"></i> Meus Serviços
                        </a>
                    </nav>
                </div>

                <!-- SEÇÃO DE PERFIL -->
                <div id="perfil" class="p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Informações Pessoais</h2>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome Completo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                                <input type="text" value="<?= htmlspecialchars($usuario['Nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-primary-500 focus:border-primary-500" readonly>
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" value="<?= htmlspecialchars($usuario['Email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-primary-500 focus:border-primary-500" readonly>
                            </div>
                            
                            <!-- Telefone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="tel" value="<?= htmlspecialchars($usuario['Celular'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>
                        
                        <!-- Botões de Ação -->
                        <div class="flex justify-end gap-4 border-t pt-6">
                            <button type="button" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Cancelar
                            </button>
                            <button type="submit" class="px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-md">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SEÇÃO DE SERVIÇOS -->
                <div id="servico" class="p-6 md:p-8 hidden">
                    <?php if (!empty($servicos)): ?>
                        <div class="space-y-6">
                            <!-- Resumo dos Serviços -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="text-xl font-bold">Meus Serviços</h2>
                                        <p class="text-gray-600 mt-2">Você tem <?= count($servicos) ?> serviços cadastrados</p>
                                    </div>
                                    <a href="cadastro_servico.php" class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-md">
                                        <i class="fas fa-plus mr-2"></i> Novo Serviço
                                    </a>
                                </div>
                                
                                <!-- Estatísticas -->
                                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Avaliação Média -->
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <div class="flex items-center justify-center">
                                            <div class="text-yellow-400 text-2xl mr-2">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <?php if ($i <= floor($media_avaliacoes)): ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php elseif ($i - 0.5 <= $media_avaliacoes): ?>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    <?php else: ?>
                                                        <i class="far fa-star"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="font-bold"><?= $media_avaliacoes ?></span>
                                        </div>
                                        <p class="text-center text-gray-600 mt-1">Avaliação Média</p>
                                    </div>
                                    
                                    <!-- Total de Avaliações -->
                                    <div class="bg-green-50 p-4 rounded-lg text-center">
                                        <p class="text-3xl font-bold text-green-600"><?= $total_avaliacoes ?></p>
                                        <p class="text-gray-600">Avaliações Recebidas</p>
                                    </div>
                                    
                                    <!-- Favoritos -->
                                    <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                        <p class="text-3xl font-bold text-yellow-600">
                                            <?= array_sum(array_column($servicos, 'QuantidadeFavorito')) ?>
                                        </p>
                                        <p class="text-gray-600">Total de Favoritos</p>
                                    </div>
                                </div>
                                
                                <!-- Lista de Serviços -->
                                <div class="mt-8 space-y-4">
                                    <h3 class="text-lg font-semibold mb-4">Meus Serviços Cadastrados</h3>
                                    
                                    <?php foreach ($servicos as $servico): ?>
                                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-medium text-gray-800"><?= htmlspecialchars($servico['Titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?></h4>
                                                    <p class="text-gray-600 text-sm mt-1"><?= htmlspecialchars($servico['Categoria'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                                                    <p class="text-primary-500 font-medium mt-1">
                                                        R$ <?= isset($servico['Valor']) ? number_format($servico['Valor'], 2, ',', '.') : '0,00' ?>
                                                    </p>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mr-2">
                                                        <?= htmlspecialchars($servico['StatusPublicacao'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                                    </span>
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <span class="mr-3">
                                                    <i class="fas fa-heart text-red-400 mr-1"></i>
                                                    <?= htmlspecialchars($servico['QuantidadeFavorito'] ?? '0', ENT_QUOTES, 'UTF-8') ?>
                                                </span>
                                                <span>
                                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                    <?php
                                                        // Calcula média para este serviço específico
                                                        $servico_avaliacoes = array_filter($avaliacoes, function($av) use ($servico) {
                                                            return $av['IDPublicacao'] == $servico['IDPublicacao'];
                                                        });
                                                        $media_servico = !empty($servico_avaliacoes) ? 
                                                            round(array_sum(array_column($servico_avaliacoes, 'Nota')) / count($servico_avaliacoes), 1) : 0;
                                                        echo $media_servico;
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <!-- Avaliações Recentes -->
                                <?php if (!empty($avaliacoes)): ?>
                                <div class="mt-8">
                                    <h3 class="text-lg font-semibold mb-4">Avaliações Recentes</h3>
                                    
                                    <div class="space-y-4">
                                        <?php foreach (array_slice($avaliacoes, 0, 3) as $avaliacao): ?>
                                            <div class="border-b pb-4">
                                                <div class="flex items-center">
                                                    <div class="text-yellow-400">
                                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                            <?php if ($i <= ($avaliacao['Nota'] ?? 0)): ?>
                                                                <i class="fas fa-star"></i>
                                                            <?php elseif ($i - 0.5 <= ($avaliacao['Nota'] ?? 0)): ?>
                                                                <i class="fas fa-star-half-alt"></i>
                                                            <?php else: ?>
                                                                <i class="far fa-star"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <span class="ml-2 text-gray-600 text-sm">
                                                        <?= isset($avaliacao['PublicadoEm']) ? date('d/m/Y', strtotime($avaliacao['PublicadoEm'])) : '' ?>
                                                    </span>
                                                </div>
                                                <p class="mt-2 text-gray-800"><?= htmlspecialchars($avaliacao['Comentario'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Por: <?= htmlspecialchars($avaliacao['NomeUsuario'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <i class="fas fa-briefcase text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-700">Você ainda não cadastrou nenhum serviço</h3>
                            <p class="text-gray-500 mt-2 mb-6">Cadastre seu primeiro serviço para começar a receber solicitações</p>
                            <a href="cadastro_servico.php" class="inline-block px-6 py-3 bg-primary-500 hover:bg-primary-600 text-white rounded-md font-medium">
                                <i class="fas fa-plus mr-2"></i> Cadastrar Serviço
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- RODAPÉ -->
    <footer class="bg-dark-800 py-6 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        // Menu mobile toggle
        document.getElementById('menuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        // Upload de foto de perfil
        document.querySelector('.relative button').addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.click();
            
            input.onchange = function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.querySelector('.profile-image').src = event.target.result;
                        // Aqui você pode adicionar o código para enviar a imagem ao servidor
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            };
        });

        // Alternar entre abas
        const links = document.querySelectorAll('[href="#perfil"], [href="#servico"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Atualiza aba ativa
                document.querySelectorAll('[href="#perfil"], [href="#servico"]').forEach(el => {
                    el.classList.remove('border-primary-500', 'text-primary-500');
                    el.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700');
                });
                this.classList.add('border-primary-500', 'text-primary-500');
                this.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700');
                
                // Mostra seção correspondente
                document.getElementById('perfil').classList.add('hidden');
                document.getElementById('servico').classList.add('hidden');
                document.querySelector(this.getAttribute('href')).classList.remove('hidden');
            });
        });
    </script>
</body>
</html>