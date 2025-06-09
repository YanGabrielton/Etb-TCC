<?php
session_start();
include '../backend/config/ConexaoBanco.php';

// Verifica se o usuário está logado
if(!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Busca dados do usuário no banco (exemplo)
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();
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
                                <span class="bg-primary-500/10 text-primary-500 px-3 py-1 rounded-full text-sm">Usuário</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ABA DE NAVEGAÇÃO -->
                <div class="border-b border-gray-200">
                    <nav class="flex overflow-x-auto">
                        <a href="#" class="border-b-2 border-primary-500 text-primary-500 px-6 py-4 font-medium whitespace-nowrap">
                            <i class="fas fa-user-circle mr-2"></i> Perfil
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <!-- RODAPÉ (igual ao seu padrão) -->
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
    </script>
</body>
</html>