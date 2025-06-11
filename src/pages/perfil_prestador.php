<?php
session_start();
include '../backend/config/ConexaoBanco.php';

// Verifica se o usuário está logado
if(!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Busca dados do usuário no banco
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();

// Busca o serviço do prestador
$stmt_servico = $pdo->prepare("SELECT * FROM servicos WHERE prestador_id = ?");
$stmt_servico->execute([$usuario_id]);
$servico = $stmt_servico->fetch();

// Busca avaliações
$stmt_avaliacoes = $pdo->prepare("SELECT * FROM avaliacoes WHERE servico_id = ?");
$stmt_avaliacoes->execute([$servico['id']]);
$avaliacoes = $stmt_avaliacoes->fetchAll();

// Calcula média de avaliações
$media_avaliacoes = 0;
if(count($avaliacoes) > 0) {
    $soma = 0;
    foreach($avaliacoes as $av) {
        $soma += $av['nota'];
    }
    $media_avaliacoes = round($soma / count($avaliacoes), 1);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu Perfil - Job4You</title>
    
    <!-- CSS global -->
    <link rel="stylesheet" href="/src/css/global.css">
    
    <!-- Tailwind CSS direto da CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração personalizada do Tailwind -->
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
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .star-rating {
            unicode-bidi: bidi-override;
            color: #c5c5c5;
            font-size: 25px;
            position: relative;
            display: inline-block;
        }
        .star-rating .filled {
            color: #F59E0B;
            position: absolute;
            display: block;
            top: 0;
            left: 0;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-white font-sans flex flex-col min-h-screen">

    <!-- MENU DE NAVEGAÇÃO -->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors" href="index.php">Job4You</a>
            
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="#">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="perfil_prestador.php">Meu Perfil</a>                 
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors" 
                   href="./src/pages/logout.php">Sair</a>
            </div>

            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="#">Sobre</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" 
               href="./src/pages/logout.php">Sair</a>
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
                            <img src="<?= $usuario['foto_perfil'] ?: 'https://via.placeholder.com/150' ?>" 
                                 alt="Foto de perfil" 
                                 class="profile-image rounded-full border-4 border-primary-500">
                            <button class="absolute bottom-2 right-2 bg-primary-500 hover:bg-primary-600 text-white rounded-full p-2">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl font-bold"><?= htmlspecialchars($usuario['nome']) ?></h1>
                            <p class="text-gray-300 mt-1">Olá <?= htmlspecialchars(explode(' ', $usuario['nome'])[0]) ?>!</p>
                            <div class="mt-3 flex justify-center md:justify-start gap-2">
                                <span class="bg-blue-500/10 text-blue-500 px-3 py-1 rounded-full text-sm">Prestador</span>
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
                            <i class="fas fa-briefcase mr-2"></i> Meu Serviço
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
                                <input type="text" value="<?= htmlspecialchars($usuario['nome']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            
                            <!-- CPF/CNPJ -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CPF/CNPJ</label>
                                <input type="text" value="<?= htmlspecialchars($usuario['documento']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" value="<?= htmlspecialchars($usuario['email']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            
                            <!-- Telefone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="tel" value="<?= htmlspecialchars($usuario['telefone']) ?>" 
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

                <!-- SEÇÃO DE SERVIÇO -->
                <div id="servico" class="p-6 md:p-8 hidden">
                    <?php if($servico): ?>
                        <div class="space-y-6">
                            <!-- Resumo do Serviço -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="text-xl font-bold"><?= htmlspecialchars($servico['titulo']) ?></h2>
                                        <p class="text-gray-600 mt-2"><?= htmlspecialchars($servico['descricao']) ?></p>
                                    </div>
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Ativo</span>
                                </div>
                                
                                <!-- Estatísticas -->
                                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Avaliação Média -->
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <div class="flex items-center justify-center">
                                            <div class="star-rating">
                                                ★★★★★
                                                <div class="filled" style="width: <?= ($media_avaliacoes / 5) * 100 ?>%">★★★★★</div>
                                            </div>
                                            <span class="ml-2 font-bold"><?= $media_avaliacoes ?></span>
                                        </div>
                                        <p class="text-center text-gray-600 mt-1">Avaliação Média</p>
                                    </div>
                                    
                                    <!-- Total de Avaliações -->
                                    <div class="bg-green-50 p-4 rounded-lg text-center">
                                        <p class="text-3xl font-bold text-green-600"><?= count($avaliacoes) ?></p>
                                        <p class="text-gray-600">Avaliações Recebidas</p>
                                    </div>
                                    
                                    <!-- Favoritos -->
                                    <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                        <p class="text-3xl font-bold text-yellow-600"><?= $servico['favoritos'] ?? 0 ?></p>
                                        <p class="text-gray-600">Quantidade de Favoritos</p>
                                    </div>
                                </div>
                                
                                <!-- Avaliações Recentes -->
                                <div class="mt-8">
                                    <h3 class="text-lg font-semibold mb-4">Avaliações Recentes</h3>
                                    <div class="space-y-4">
                                        <?php if(count($avaliacoes) > 0): ?>
                                            <?php foreach(array_slice($avaliacoes, 0, 3) as $avaliacao): ?>
                                                <div class="border-b pb-4">
                                                    <div class="flex items-center">
                                                        <div class="text-yellow-400">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <?php if($i <= $avaliacao['nota']): ?>
                                                                    <i class="fas fa-star"></i>
                                                                <?php elseif($i - 0.5 <= $avaliacao['nota']): ?>
                                                                    <i class="fas fa-star-half-alt"></i>
                                                                <?php else: ?>
                                                                    <i class="far fa-star"></i>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <span class="ml-2 text-gray-600"><?= date('d/m/Y', strtotime($avaliacao['data_avaliacao'])) ?></span>
                                                    </div>
                                                    <p class="mt-2 text-gray-800"><?= htmlspecialchars($avaliacao['comentario']) ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-gray-500 italic">Nenhuma avaliação recebida ainda.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <!-- Botões de Ação -->
                                <div class="mt-8 pt-6 border-t flex justify-end space-x-4">
                                    <button class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                        Editar Serviço
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <i class="fas fa-briefcase text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-700">Você ainda não cadastrou um serviço</h3>
                            <p class="text-gray-500 mt-2 mb-6">Cadastre seu serviço para começar a receber solicitações</p>
                            <button class="px-6 py-3 bg-primary-500 hover:bg-primary-600 text-white rounded-md font-medium">
                                <i class="fas fa-plus mr-2"></i> Cadastrar Serviço
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- RODAPÉ (padrão igual ao seu) -->
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